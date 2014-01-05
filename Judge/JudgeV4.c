/*
########################################################
Inscription - Online Programmming contest
Engineer 2010 (oct22nd-25th) www.engineer.org.in
Mathematics and computer events - online committee
@author :: Veeresh.B veereshbeeram@gmail.com
ChangeLog::
my
#######################################################
*/

/*
##################IMPORTANT NOTES################
Please follow proper coding standards.
Refer Coding standards in the file "codinginfo".

compiliation command for this program
$gcc -o judge.o $(mysql_config --cflags) judge.c $(mysql_config --libs)

#################################################
*/

/*
#######################################################
INSCRIPTION 2010 BACKEND JUDGE'S PRIMARY PROGRAM
#######################################################
*/

// INCLUDE section
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <signal.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <mysql/my_global.h>
#include <mysql/mysql.h>
#include <sys/timeb.h>
#include <sys/wait.h>
#include <errno.h>

// #define(s) section
#define SLEEPTIME 2
#define C 1
#define CPP 2
#define JAVA 3
#define TEXT 4
#define ACCEPTED 0
#define WRONG_ANSWER 1
#define COMPILATION_ERROR 2
#define TIME_LIMIT_EXCEEDED 3
#define SEGMENTATION_FAULT 4
#define ARITHMETIC_EXCEPTION 5
#define RUN_TIME_ERROR 6
#define WAITING 7
#define INDIR "./input/"
#define OUTDIR "./output/"
#define SUBMISSIONDIR "./code/"
#define RUNNINGDIR "./sandbox/"
// GLOBAL VARIABLES section

//---------------- DB VARS FROM CONFIG FILE----------------------
char *SERVERNAME,*DBUSERNAME,*DBPASSWORD,*DBNAME;
int PORT;
int JAVAFAC=40;

//---------------------------------------------------------------

int statusResult=ACCEPTED;
volatile int keeprunning = 1;   //tells if the judge has to keep running or not
int curSubmission; 		// tells the current submission ID processed by the judge
int curLang; 			// keeps track of language of current submisison
int curProb;			// keeps track of which problem we are dealing with
MYSQL *conn;
MYSQL_RES *res;
MYSQL_ROW row;
char *curFile; 			// keeps full path of current input file
float runTime;
char *getSubmissionQuery;
int timing[20][3]; 		// timing[probID][LANG-1]
char *javaids[] = { "","one","two","three","four","five","six","seven","eight","nine","ten","eleven","tweleve" };
int runMode;

// FUNCTION declarations
int executer();
int getsubmission();
int fetch();
void updateResult();
void initialize_judge();
void end_judge();
void signal_handler(int);

// FUNCTION definitions



/*
 * Exectuer function is called after fetching a submission.. This is responsible for executing and returning the
 * timing and status of the execution
 *
 */

	int executer(){
		int tempretval,impretval,loop=1;
		char *tempstr;
		struct timeb startt,endt;	// timing structures
		printf("\t\texecuter() : Function entered\n");
	//re-initialize submission specific variables
		statusResult=ACCEPTED;
		runTime=0.00;

		tempstr = malloc(100);
		if(tempstr == NULL){
			printf("\t\texecuter(): tempstr malloc failed exiting\n");
			exit(1);
		}
	// purge sandbox folder!! 
		tempretval = system("rm -rf "RUNNINGDIR"*");
		if(tempretval!=0){
			printf("\t\texecuter(): bash command purge sandbox failed exiting\n");
			exit(1);
		}
	// copy code file to sandbox
		sprintf(tempstr,"cp %s "RUNNINGDIR,curFile);
		tempretval = system(tempstr);
		if(tempretval!=0){
			printf("\t\texecuter(): bash command copy code to sandbox failed exiting\n");
			exit(1);
		}

		tempretval=chdir(RUNNINGDIR);
		if(tempretval!=0){
			printf("\t\texecuter(): chdir to RUNNINGDIR failed exiting\n");
			exit(1);
		}

	// compile the code and return errors with predefined error status messages
		switch(curLang){
			case 1:
			// it is c code
				impretval = system("gcc -lm -w -o run *.c");
				if(impretval ==0){
					printf("\t\t\texecuter() : Compilation Successful\n");
					loop=1;
				}
				else{
					statusResult=COMPILATION_ERROR;
					printf("\t\t\texecuter() : Compiliation Failure :: %d\n",WEXITSTATUS(impretval));
				}
				break;
			case 2:
			// it is cpp code
				impretval = system("g++ -lm -O2 -w -o run *.cpp");
				if(impretval ==0){
					printf("\t\t\texecuter() : Compilation Successful\n");
					loop=1;
				}
				else{
					statusResult=COMPILATION_ERROR;
					printf("\t\t\texecuter() : Compiliation Failure :: %d\n",WEXITSTATUS(impretval));
					loop=0;
				}
				break;
			case 3:
			// Java
				impretval=0;
				sprintf(tempstr,"mv *.java %s.java",javaids[curProb]);
				tempretval = system(tempstr);
				if(tempretval!=0){
					printf("\t\texecuter(): Java file rename failed\n");
					exit(1);
				}
				sprintf(tempstr,"../java/bin/javac %s.java",javaids[curProb]);
				impretval= system(tempstr);
				if(impretval ==0){
					printf("\t\t\texecuter() : java Compilation Successful\n");
					loop=2;
				}
				else{
					statusResult=COMPILATION_ERROR;
					printf("\t\t\texecuter() : java Compiliation Failure :: %d\n",WEXITSTATUS(impretval));
					loop=0;
				}

				break;
			case 4:
			// text file IPSC format problem
				loop=3;
				impretval = 0;
				break;
			default:
				statusResult=COMPILATION_ERROR;
				printf("\t\t\texecuter() : Unsupported language\n");
				loop=0;
				break;
		}
		tempretval = chdir("..");
		if(tempretval!=0){
			printf("\t\texecuter(): chdir to HOME failed exiting\n");
			exit(1);
		}

		if(impretval ==0  && loop==1){
	// compiliation succeeded so going for execution	
		// copy input and output files
			sprintf(tempstr,"cp "INDIR"%d "RUNNINGDIR"intext",curProb);
			tempretval = system(tempstr);
			if(tempretval!=0){
				printf("\t\texecuter(): bash command copy intext to sandbox failed exiting\n");
				exit(1);
			}

			
			sprintf(tempstr,"cp "OUTDIR"%d "RUNNINGDIR"outtext",curProb);
			tempretval = system(tempstr);
			if(tempretval!=0){
				printf("\t\texecuter(): bash command copy outtext to sandbox failed exiting\n");
				exit(1);
			}

		// Run the Program
			ftime(&startt);
			sprintf(tempstr,"./run.sh %d",timing[curProb][curLang]);
			//printf("Run command is %s\n",tempstr);
			impretval = system(tempstr);
			ftime(&endt);
		// evaluate the run
			runTime = (float)((endt.time-startt.time)*1000 +(endt.millitm-startt.millitm))/1000;
			printf("\t\t\texecuter() : Final run Time %.3f",runTime);
			//printf("Ran with %d\n",WEXITSTATUS(retval));
			impretval = WEXITSTATUS(impretval);
			if(impretval!=0){
				switch(impretval){
					case 137 : statusResult=TIME_LIMIT_EXCEEDED;
						break;	
					case 139 : statusResult=SEGMENTATION_FAULT;
						break;
					case 136 : statusResult = ARITHMETIC_EXCEPTION ;
						break;
					default:statusResult=RUN_TIME_ERROR;
						break;
				}	
	
			}
			else{
			// Run was successful.. so check output!!
				impretval = system("diff  -u -bB "RUNNINGDIR"outtext "RUNNINGDIR"progoutput > /dev/null");
			//printf("RETVAL DIFF %d",retval);
				if(impretval!=0)
					statusResult = WRONG_ANSWER;
				else
					statusResult = ACCEPTED;
			}

		}
		else  if(impretval ==0 && loop==2){
			sprintf(tempstr,"cp "INDIR"%d "RUNNINGDIR"intext",curProb);
			tempretval = system(tempstr);
			if(tempretval!=0){
				printf("\t\texecuter(): bash command copy intext to sandbox failed exiting\n");
				exit(1);
			}

			
			sprintf(tempstr,"cp "OUTDIR"%d "RUNNINGDIR"outtext",curProb);
			tempretval = system(tempstr);
			if(tempretval!=0){
				printf("\t\texecuter(): bash command copy outtext to sandbox failed exiting\n");
				exit(1);
			}

		// Run the Program
		tempretval=chdir(RUNNINGDIR);
		if(tempretval!=0){
			printf("\t\texecuter(): java chdir to RUNNINGDIR failed exiting\n");
			exit(1);
		}

			ftime(&startt);
			sprintf(tempstr,"../runjava.sh %s %d",javaids[curProb],timing[curProb][curLang]*JAVAFAC);
			//printf("Run command is %s\n",tempstr);
			impretval = system(tempstr);
			ftime(&endt);
		tempretval=chdir("..");
		if(tempretval!=0){
			printf("\t\texecuter(): java chdir to .. failed exiting\n");
			exit(1);
		}
		// evaluate the run
			runTime = (float)((endt.time-startt.time)*1000 +(endt.millitm-startt.millitm))/1000;
			printf("\t\t\texecuter() : Final run Time %.3f",runTime);
			//printf("Ran with %d\n",WEXITSTATUS(retval));
			impretval = WEXITSTATUS(impretval);
			if(impretval!=0){
					statusResult=RUN_TIME_ERROR;
	
			}
			else{
			// Run was successful.. so check output!!
				impretval = system("diff  -u -bB -i "RUNNINGDIR"outtext "RUNNINGDIR"progoutput > /dev/null");
			//printf("RETVAL DIFF %d",retval);
				if(impretval!=0)
					statusResult = WRONG_ANSWER;
				else
					statusResult = ACCEPTED;
			}

		}
		else  if(impretval ==0 && statusResult==ACCEPTED && loop==3){
		//Text file running
			sprintf(tempstr,"cp "OUTDIR"%d "RUNNINGDIR"outtext",curProb);
			tempretval = system(tempstr);
			if(tempretval!=0){
				printf("\t\texecuter(): bash command copy outtext to sandbox in text execution failed exiting\n");
				exit(1);
			}

			tempretval = chdir(RUNNINGDIR);
			if(tempretval!=0){
				printf("\t\texecuter(): chdir to RUNNINGDIR failed exiting\n");
				exit(1);
			}
			tempretval = system("mv *.txt progoutput");
			if(tempretval!=0){
				printf("\t\texecuter(): bash command mv text file to progoutput failed exiting\n");
				exit(1);
			}
			impretval = system("diff  -u -bB outtext progoutput > /dev/null");
			tempretval = chdir("..");
			if(tempretval!=0){
				printf("\t\texecuter(): chdir to HOME failed exiting\n");
				exit(1);
			}
		//printf("RETVAL DIFF %d",retval);
			if(impretval!=0)
				statusResult = WRONG_ANSWER;
			else
				statusResult = ACCEPTED;
			
		}
		else
			printf("\t\t\texecuter() : skipped execution loop\n");
		free(tempstr);
		//printf("-----------Status Result : %d--------------\n",statusResult);
	}

// gets a submission from the database and return the number of rows returned . Numrows is either 1 or 0 (this is by design)
// Here ERRORS are handleable... if we get an error.. just return 0, so that we can re-try again. Beyond this stage.. every error is fatal since
// we already have the submission with us
	int get_submission(){
		int numrows=0;
		printf("\t\tget_submission() : function entered\n");
		conn = mysql_init(NULL);
		if (!mysql_real_connect(conn, SERVERNAME,DBUSERNAME, DBPASSWORD, DBNAME, PORT, NULL, CLIENT_MULTI_RESULTS)) {
		// Use below statement always to check for errors.. shows mysql error codes.. easy to debug      
			printf("\t\t\tget_submission() : init Judge %d: %s \n",mysql_errno(conn), mysql_error(conn));
		      return 0;
		   }
		 if (mysql_query(conn, getSubmissionQuery)) {
			printf("\t\t\tget_submission() : GetSub query :: %d: %s \n",mysql_errno(conn), mysql_error(conn));
    			  return 0;
  		 }
		res = mysql_use_result(conn);
	//printf("IN GetSub use_result:: %d: %s \n",mysql_errno(conn), mysql_error(conn));
		if((row = mysql_fetch_row(res))!=NULL){
		numrows++;
		}

		return numrows;
	}




/*
 * Main exection function returns 1 if a submission was processed else returns 0
 * The functions of this function: Get a submission from database. Store the code on file system
 * Execute the code and get final result for this submission.
 * Upload the result to database. return
 * The security implementations for the code are handled outside by OS tools.
 */

	int fetch(){
		int numrows;
		int tempi;
		FILE *submissionfile;
		printf("\tfetch():function entered\n");
		numrows = get_submission();
		if(numrows == 1){
			curSubmission = atoi(row[0]);
			curProb = atoi(row[1]);			
			curLang = atoi(row[2]);
						
			switch(curLang){
				case C: sprintf(curFile,SUBMISSIONDIR"%d.c",curSubmission);
					printf("\t\tfetch(): processing submission, submissionID::%d \t language::C\n",curSubmission);
					break;
				case CPP: sprintf(curFile,SUBMISSIONDIR"%d.cpp",curSubmission);
					printf("\t\tfetch(): processing submission, submissionID::%d \t language::CPP\n",curSubmission);
					break;
				case JAVA: sprintf(curFile,SUBMISSIONDIR"%d.java",curSubmission);
					printf("\t\tfetch(): processing submission, submissionID::%d \t language::JAVA\n",curSubmission);
					break;	
				case TEXT: sprintf(curFile,SUBMISSIONDIR"%d.txt",curSubmission);
					printf("\t\tfetch(): processing submission, submissionID::%d \t language::TEXT\n",curSubmission);
					break;		
			}
/*			tempi = creat(curFile,O_CREAT|O_RDWR);
			if(tempi == -1){
				printf("\t\tfetch():file creating failed\n");
				perror("fetch(): creat code\n");
				exit(1);
			}
			close(tempi);
*/
			submissionfile = fopen(curFile,"w");
			if(submissionfile == NULL){
				printf("\t\tfetch():file opening failed\n");
				perror("fetch(): store code\n");
				keeprunning = 0;
				exit(1);
			}
			//strcpy(tempstr,row[1]);
			//strcat(tempstr,"\0");
							
			fprintf(submissionfile,"%s",row[3]);
			printf("\t\tfetch():Created file %s and wrote to it for problem %d \n",curFile,curProb);
			//printf("executer():we are dealing with problem%d\n",curProb);
			fclose(submissionfile);

		//NOW call executer function
			executer();
		}
		mysql_free_result(res);
		mysql_close(conn);
	//time to upload the result back to database!!
		if(numrows>0)
			updateResult();

		return numrows;

		
	}


// This function is used to upload the status of the execution back to database
	void updateResult(){
		char *queryString;
		printf("\t\tupdateResult() : function entered\n");
		
		queryString = malloc(100);
		if(queryString==NULL){
			printf("\t\tupdateResult() : queryString malloc failed .. exiting ");
			exit(1);
		}
		
		sprintf(queryString,"call updateResult('%d','%d','%f');",curSubmission,statusResult,runTime);
		conn = mysql_init(NULL);
		if (!mysql_real_connect(conn, SERVERNAME,DBUSERNAME, DBPASSWORD, DBNAME, PORT, NULL, CLIENT_MULTI_RESULTS)) {
		// Use below statement always to check for errors.. shows mysql error codes.. easy to debug      
			printf("\t\t\tupdateResult() : init Judge %d: %s \n",mysql_errno(conn), mysql_error(conn));
		      exit(1);
		   }
		//printf("--Query string for updating %s--",queryString);
		 if (mysql_query(conn, queryString)) {
			printf("\t\t\tupdateResult() : GetSub query :: %d: %s \n",mysql_errno(conn), mysql_error(conn));
    			exit(1);
  		 }
		free(queryString);
		printf("\t#-----------Status Result : %d--------------#\n\n",statusResult);

	}


// Initializing function for the judge to begin its work
// Any ERROR in initialize_judge() is fatal... should exit immediately!!

	void initialize_judge(){

		int pid,tempi;
		char *temp;
		FILE *tempfile;
		int tempretval;
		printf("\tinitialize_judge(): function entered\n");		
		conn = mysql_init(NULL);

	// Connection to database 
		if (!mysql_real_connect(conn, SERVERNAME,DBUSERNAME, DBPASSWORD, DBNAME, PORT, NULL, CLIENT_MULTI_RESULTS)) {
		// Use below statement always to check for errors.. shows mysql error codes.. easy to debug      
			printf("\t\tinitialize_judge(): Connect error %d: %s \n",mysql_errno(conn), mysql_error(conn));
			exit(1);
		   }
		 if (mysql_query(conn, "select problemID,ctime,cpptime,javatime from problems")) {
			printf("\t\tinitialize_judge() : GetData query :: %d: %s \n",mysql_errno(conn), mysql_error(conn));
    			exit(1);
  		 }
		res = mysql_use_result(conn);
		while((row = mysql_fetch_row(res))!=NULL){
			pid = atoi(row[0]);
						
			timing[pid][1]=atoi(row[1]);
			timing[pid][2]=atoi(row[2]);
			timing[pid][3]=atoi(row[3]);
		}
		/*
		for(i=0;i<20;i++){
			for(j=0;j<3;j++)
				printf("%s\t",timing[i][j+1]);
			printf("\n");
		}
		*/ // OOPS works!!
		mysql_free_result(res);
		if(runMode ==0){
			printf("\t\tinitialize_judge(): runMode is 0, skipping download of imput and output files\n");
			mysql_close(conn);
			return;
		}
	// purge input and output folders before starting 

		tempretval = system("rm -f "INDIR"*");
			if(tempretval!=0){
				printf("\t\tinitialize_judge(): bash command purge input folder failed exiting\n");
				exit(1);
			}

		tempretval = system("rm -f "OUTDIR"*");
			if(tempretval!=0){
				printf("\t\tinitialize_judge(): bash command purge input folder failed exiting\n");
				exit(1);
			}

	
		 if (mysql_query(conn, "select problemID,inputFile,outputFile from problems")) {
			printf("\t\tinitialize_judge() : GetFiles query :: %d: %s \n",mysql_errno(conn), mysql_error(conn));
    			  exit(1);
  		 }
		res = mysql_use_result(conn);
		temp = malloc(100);
		if(temp==NULL){
			printf("\t\tinitialize_judge() : temp malloc failed .. exiting ");
			exit(1);
		}
		while((row = mysql_fetch_row(res))!=NULL){
			
			sprintf(temp,INDIR"%s",row[0]);
/*			tempi = open(temp,O_CREAT);
			if(tempi == -1){
				printf("\t\tinitialize_judge(): Input file creating failed\n");
				exit(1) ;
			}
			close(tempi);
*/
			tempfile = fopen(temp,"w");
			if(tempfile == NULL){
				perror("\t\tinitialize_judge(): input fopen()\n");
				exit(1) ;
			}
							
			fprintf(tempfile,"%s",row[1]);
			fclose(tempfile);

			sprintf(temp,OUTDIR"%s",row[0]);
/*			tempi = creat(temp,O_CREAT);
			if(tempi == -1){
				printf("\t\tinitialize_judge(): output file creating failed\n");
				exit(1) ; 
			}
*/			close(tempi);

			tempfile = fopen(temp,"w");
			if(tempfile == NULL){
				printf("\t\tinitialize_judge(): output Created file opening Failed for Problem %s\n",row[0]);
				perror("\t\tinitialize_judge(): output fopen()\n");
				exit(1) ;
			}
							
			fprintf(tempfile,"%s",row[2]);
			fclose(tempfile);
		}
		free(temp);
		mysql_close(conn);
	}
	
// function called at the end to do housekeeping and clean up
	void end_judge(){
		printf("\tend_judge(): function entered\n");
		// TODO depending on exitstatus release the lock on curSubmision
		mysql_close(conn);

	}

// Signal Handling
	// we need to handle SIGTERM,SIGINT,SIGQUIT and SIGHUP
	void signal_handler(int signum){
		printf("Interrupt Signal Got.... quitting\n");
		keeprunning = 0;
			
	}


// Default entry point function the main function

	int main(int argc,char *argv[]){
		int i;
		int execret=0;
		float sleeptime=SLEEPTIME;
		char dummyString[2];
		printf("main(): function entered\n");
	// signal handler specification
		signal(SIGTERM,signal_handler);
		signal(SIGINT,signal_handler);
		signal(SIGQUIT,signal_handler);
		signal(SIGHUP,signal_handler);
	// argument verification
		if(argc<3){
			printf("\tmain(): Kindly pass JudgeID and runMode as an argument\n");
			keeprunning=0;
			return 0;
		}
		runMode = atoi(argv[2]);
		getSubmissionQuery = malloc(100);
		if(getSubmissionQuery == NULL){
			printf("\tmain(): malloc getsubmissionQuery failed exiting");
			exit(1);
		}
		curFile = malloc(1024);		
		if(curFile == NULL){
			printf("\tmain(): malloc curFile failed exiting");
			exit(1);
		}
		SERVERNAME = malloc(200);		
		if(SERVERNAME == NULL){
			printf("\tmain(): malloc SERVERNAME failed exiting");
			exit(1);
		}
		DBUSERNAME = malloc(200);		
		if(DBUSERNAME == NULL){
			printf("\tmain(): malloc DBUSERNAME failed exiting");
			exit(1);
		}
		DBPASSWORD = malloc(200);		
		if(DBPASSWORD == NULL){
			printf("\tmain(): malloc DBPASSWORD failed exiting");
			exit(1);
		}
		DBNAME = malloc(200);		
		if(DBNAME == NULL){
			printf("\tmain(): malloc DBNAME failed exiting");
			exit(1);
		}

		scanf("%s",SERVERNAME);
		scanf("%s",DBUSERNAME);
		scanf("%s",DBPASSWORD);
		scanf("%s",DBNAME);
		scanf("%d",&PORT);
	// Getting DB parameters from config file
		sprintf(getSubmissionQuery,"CALL getsubmission('%s')",argv[1]);
		//printf("%s\n",getSubmissionQuery);
		initialize_judge();	// used to get all timing info initially
	// main execution loop
		while(keeprunning == 1){
			//printf("\tmain() : running Loop Entered\n");
			execret = fetch();
	//TODO need to adjust the sleep time based on real-time feedback
			//printf("returned::%d\n",execret);
			if(execret == 0){
				printf("\tmain(): No submissions got.... zzzzzzz for %d seconds\n",(int)sleeptime);			
				sleep((int)sleeptime);
				//sleeptime+=0.1;
			}
			else
				sleeptime=SLEEPTIME;
			//gets(dummyString);
		}
		//end_judge();
		free(getSubmissionQuery);
		free(curFile);
		return 0;
	}
