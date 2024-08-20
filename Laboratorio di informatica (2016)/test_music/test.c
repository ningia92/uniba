/*
 * test.c
 *
 *  Created on: 08 mag 2016
 *      Author: GianMarco
 */

#include <stdlib.h>
#include "CUnit/Basic.h"
#include "music.h"
#include "brano.h"

#define MAX 1000
#define MIN -MAX


/*
 * Aggiungere tutti i metodi di test per le funzioni da testare
 */
void test_scambia(void) {

}

void test_QSort(void) {
	BRANO brani[4];
	BRANO brani2[4];

	strcpy(brani[0].campo[2].dato, "z");
	strcpy(brani[1].campo[2].dato, "salsa");
	strcpy(brani[2].campo[2].dato, "rock");
	strcpy(brani[3].campo[2].dato, "reggae");

	strcpy(brani2[0].campo[2].dato, "reggae");
	strcpy(brani2[1].campo[2].dato, "rock");
	strcpy(brani2[2].campo[2].dato, "salsa");
	strcpy(brani2[3].campo[2].dato, "z");

	QSort(brani, 0, 3, 3);

	puts(brani[0].campo[2].dato);
	puts(brani[1].campo[2].dato);
	puts(brani[2].campo[2].dato);
	puts(brani[3].campo[2].dato);

	puts(brani2[0].campo[2].dato);
	puts(brani2[1].campo[2].dato);
	puts(brani2[2].campo[2].dato);
	puts(brani2[3].campo[2].dato);

	CU_ASSERT_STRING_EQUAL(brani[0].campo[2].dato, brani2[0].campo[2].dato);
	CU_ASSERT_STRING_EQUAL(brani[1].campo[2].dato, brani2[1].campo[2].dato);
	CU_ASSERT_STRING_EQUAL(brani[2].campo[2].dato, brani2[2].campo[2].dato);
	CU_ASSERT_STRING_EQUAL(brani[3].campo[2].dato, brani2[3].campo[2].dato);

	/*CU_ASSERT(strcmp("metal", "pop")<0);
	CU_ASSERT(strcmp("rock", "reggae")>0);
	CU_ASSERT_STRING_EQUAL("rock", "rock");
	CU_ASSERT_STRING_NOT_EQUAL("rock", "ROCK");
	CU_ASSERT_STRING_NOT_EQUAL("rock", "r ock");
	CU_ASSERT_STRING_NOT_EQUAL("rock", "reggae");
	CU_ASSERT_STRING_EQUAL("*", "*");
	CU_ASSERT_STRING_NOT_EQUAL("***", "**");*/
}

void test_ricerca_brani(void) {
	CU_ASSERT(strcmp("metal", "pop")<0);
	CU_ASSERT(strcmp("rock", "reggae")>0);
	CU_ASSERT_STRING_EQUAL("rock", "rock");
	CU_ASSERT_STRING_NOT_EQUAL("rock", "ROCK");
	CU_ASSERT_STRING_NOT_EQUAL("rock", "r ock");
	CU_ASSERT_STRING_NOT_EQUAL("rock", "reggae");
	CU_ASSERT_STRING_EQUAL("*", "*");
	CU_ASSERT_STRING_NOT_EQUAL("***", "**");
}

void test_stampa_brani(void) {
	CU_ASSERT_STRING_EQUAL("ciao", "ciao");
	CU_ASSERT_STRING_NOT_EQUAL("ciao", "CIAO");
	CU_ASSERT_STRING_NOT_EQUAL("ciao", "c iao");
	CU_ASSERT_STRING_NOT_EQUAL("grazie", "grazia");
}

/*
 * Funzioni di inizializzazione e pulizia delle suite.
 * Di default sono funzioni vuote.
 */
int init_suite_default(void) {
	return 0;
}

int clean_suite_default(void) {
	return 0;
}


/* **************************************************
 *	TEST di UNITA'
 */

int main() {
	/* inizializza registro - e' la prima istruzione */
	CU_initialize_registry();

	/* Aggiungi le suite al test registry */
	CU_pSuite pSuite_ordinamento = CU_add_suite("ORDINAMENTO", init_suite_default, clean_suite_default);
	CU_pSuite pSuite_ricerca = CU_add_suite("RICERCA", init_suite_default, clean_suite_default);
	CU_pSuite pSuite_stampa = CU_add_suite("STAMPA", init_suite_default, clean_suite_default);

	/* Aggiungi i test alle suite
	 * NOTA - L'ORDINE DI INSERIMENTO E' IMPORTANTE
	 */
	CU_add_test(pSuite_ordinamento, "test of scambia()", test_scambia);

	CU_add_test(pSuite_ordinamento, "test of QSort()", test_QSort);

	CU_add_test(pSuite_ricerca, "test of ricerca_brani()", test_ricerca_brani);

	CU_add_test(pSuite_stampa, "test of stampa_brani()", test_stampa_brani);

	/* Esegue tutti i casi di test con output sulla console */
	CU_basic_set_mode(CU_BRM_VERBOSE);
	CU_basic_run_tests();

	/* Pulisce il registro e termina lo unit test */
	CU_cleanup_registry();

	system("pause");
	return CU_get_error();
}


