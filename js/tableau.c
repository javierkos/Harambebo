#include <stdio.h> 
#include <string.h>   /* for all the new-fangled string functions */
#include <stdlib.h>     /* malloc, free, rand */

int Fsize=50;
int cases=10;


int i;
int j;

/*typedef struct tableau tableau;*/

struct tableau {
  char *root;
  struct  tableau *left;
  struct tableau *right;
  struct tableau *parent;
}*tab, *node, *node1, *kid, *pa;

int countBrack(char *g){
	int i=0,b=0;
	while (g[i]!=\0){
		if (g[i]=='('){
			b++;
		}
	}
	return b;
}

int parse(char *g){

}

int main(void){
	char ch;
	FILE *fp;
	fp=fopen("input.txt","r");
	if (fp=NULL){
	  perror("Error while opening the file.\n");
      exit(EXIT_FAILURE);
	}
	while( ( ch = fgetc(fp) ) != EOF )
      printf("%c",ch);
 
   fclose(fp);
}
/*put all your functions here.  You will need
1.
int parse(char *g) which returns 1 if a proposition, 2 if neg, 3 if binary, ow 0
2. 
void complete(struct tableau *t)
which expands the root of the tableau and recursively completes any child tableaus.
3. 
int closed(struct tableau *t)
which checks if the whole tableau is closed.
Of course you will almost certainly need many other functions.

You may vary this program provided it reads 10 formulas in a file called "input.txt" and outputs in the way indicated below to a file called "output.txt".
*/