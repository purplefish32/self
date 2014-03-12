<?php

namespace Innova\SelfBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Innova\SelfBundle\Entity\MediaType;
use Innova\SelfBundle\Entity\Duration;
use Innova\SelfBundle\Entity\Level;
use Innova\SelfBundle\Entity\Skill;
use Innova\SelfBundle\Entity\Typology;
use Innova\SelfBundle\Entity\OriginStudent;
use Innova\SelfBundle\Entity\Language;
use Innova\SelfBundle\Entity\LevelLansad;
use Innova\SelfBundle\Entity\Test;
use Innova\SelfBundle\Entity\Questionnaire;
use Innova\SelfBundle\Entity\Question;
use Innova\SelfBundle\Entity\Subquestion;
use Innova\SelfBundle\Entity\Proposition;
use Innova\SelfBundle\Entity\Media;

/**
 * Symfony command to add or not fixtures. EV.
 *
*/
class ItceFixtureCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('self:fixtures:itce')
            ->setDescription('Italian CE test')
        ;
    }

    /**
     * If I have any data in database, then I don't execute fixtures. EV.
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // CREATION TEST
        $test = $this->createTest("CE Italien", "Italian");


        /*******************************************

                    NIVEAU : A1

        ********************************************/

        /*******************************************
                    QUESTIONNAIRE 1 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_1 = $this->createQuestionnaire("A1_CE_parking_gare", "A1", "CE", $test);
        $questionnaire_1->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_1->setMediaContext($this->mediaText("", "Pubblicità in stazione", ""));
        $questionnaire_1->setMediaText(
        $this->mediaText("Parcheggia l’auto e parti in treno!",
        "Lascia l’auto vicino alla stazione e parti con i treni Frecciarossa, Frecciargento e Frecciabianca.@@@ A Torino, Milano e Padova puoi avere una tariffa speciale in alcuni parcheggi e garage convenzionati, semplicemente presentando il tuo biglietto valido su treni Frecciarossa, Frecciargento e Frecciabianca.", "")
        );
        // CREATION QUESTION
        $questionnaire_1_1 = $this->createQuestion("TVF", $questionnaire_1);
        // CREATION SUBQUESTION
        //$questionnaire_1_1_1 = $this->createSubquestion("QRM", $questionnaire_1_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_1_1_1_1 = $this->createProposition("L’offerta è valida solo in alcune città.", true, $questionnaire_1_1_1);
        //$questionnaire_1_1_1_2 = $this->createProposition("Con il biglietto del treno il parcheggio per l’automobile è gratuito.", true, $questionnaire_1_1_1);
        //$questionnaire_1_1_1_3 = $this->createProposition("Per avere tariffa speciale è necessario presentare il biglietto del treno.", true, $questionnaire_1_1_1);
        // CREATION SUBQUESTION
        $questionnaire_1_1_1 = $this->createSubquestionVF("VF", $questionnaire_1_1, "", "L’offerta è valida solo in alcune città.");
        $questionnaire_1_1_2 = $this->createSubquestionVF("VF", $questionnaire_1_1, "", "Con il biglietto del treno il parcheggio per l’automobile è gratuito.");
        $questionnaire_1_1_3 = $this->createSubquestionVF("VF", $questionnaire_1_1, "", "Per avere tariffa speciale è necessario presentare il biglietto del treno.");
        // CREATION PROPOSITIONS
        $questionnaire_1_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_1_1_1);
        $questionnaire_1_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_1_1_1);

        $questionnaire_1_1_1_2 = $this->createPropositionVF("", "VRAI", true, $questionnaire_1_1_2);
        $questionnaire_1_1_1_2 = $this->createPropositionVF("", "FAUX", false, $questionnaire_1_1_2);

        $questionnaire_1_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_1_1_3);
        $questionnaire_1_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_1_1_3);


        /*******************************************
                    QUESTIONNAIRE 2 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_2 = $this->createQuestionnaire("A1_CE_shopping_florence_1_2", "A1", "CE", $test);
        $questionnaire_2->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_2->setMediaContext($this->mediaText("", "Breve articolo su rivista femminile", ""));
        $questionnaire_2->setMediaText($this->mediaText("Le vie dello shopping a Firenze", "**1.** _________ davvero tanti i luoghi dove turisti e cittadini fiorentini **2.** __________ trascorrere una bella giornata di shopping all'aria aperta. Partendo dal centro storico, Via Tornabuoni **3.**  _______ sicuramente il posto ideale dove poter fare acquisti chic ed eleganti.", "Le vie dello shopping a Firenze", ""));
        // CREATION QUESTION
        $questionnaire_2_1 = $this->createQuestion("TQRU", $questionnaire_2);
        // CREATION SUBQUESTION
        $questionnaire_2_1_1 = $this->createSubquestion("QRU", $questionnaire_2_1, "**1.** _________ davvero tanti i luoghi dove turisti e cittadini fiorentini");
        $questionnaire_2_1_2 = $this->createSubquestion("QRU", $questionnaire_2_1, "**2.** __________ trascorrere una bella giornata di shopping all'aria aperta. Partendo dal centro storico, Via Tornabuoni ");
        $questionnaire_2_1_3 = $this->createSubquestion("QRU", $questionnaire_2_1, "**3.**  _______ sicuramente il posto ideale dove poter fare acquisti chic ed eleganti.");
        // CREATION PROPOSITIONS
        $questionnaire_2_1_1_1 = $this->createProposition("1.1. Sono", true, $questionnaire_2_1_1);
        $questionnaire_2_1_1_2 = $this->createProposition("1.2. Siamo", false, $questionnaire_2_1_1);
        $questionnaire_2_1_1_3 = $this->createProposition("1.3. é", false, $questionnaire_2_1_1);

        $questionnaire_2_1_2_1 = $this->createProposition("2.1. possiamo", false, $questionnaire_2_1_2);
        $questionnaire_2_1_2_2 = $this->createProposition("2.2.  possono", true, $questionnaire_2_1_2);
        $questionnaire_2_1_2_3 = $this->createProposition("2.3.  posso", false, $questionnaire_2_1_2);

        $questionnaire_2_1_3_1 = $this->createProposition("3.1.  č", true, $questionnaire_2_1_3);
        $questionnaire_2_1_3_2 = $this->createProposition("3.2.  sono", false, $questionnaire_2_1_3);
        $questionnaire_2_1_3_3 = $this->createProposition("3.3.  siamo ", false, $questionnaire_2_1_3);

        /*******************************************
                    QUESTIONNAIRE 3 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_3 = $this->createQuestionnaire("A1_CE_vie_tokyo", "A1", "CE", $test);
        $questionnaire_3->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_3->setMediaContext($this->mediaText("", "E-mail ad un amico", ""));
        $questionnaire_3->setMediaText($this->mediaText("Notizie da Tokyo", "Ciao Matteo,@@@qui sono le 4.00 del mattino e sono stanchissimo! Sono arrivato a Tokyo, finalmente! Il viaggio è stato davvero lungo, ho cambiato tre aerei e ho attraversato due continenti, quasi non ci credo!@@@Sull’aereo ho mangiato il primo vero sushi della mia vita, non mi è piaciuto molto!@@@Ho conosciuto una ragazza americana che studia qui al Campus, mi ha parlato molto bene della città, domani mi porta a fare un giro, poi ti racconto.@@@Buona notte a presto,@@@Giulio", ""));
        // CREATION QUESTION
        $questionnaire_3_1 = $this->createQuestion("QRM", $questionnaire_3);
        // CREATION SUBQUESTION
        $questionnaire_3_1_1 = $this->createSubquestion("QRM", $questionnaire_3_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_3_1_1_1 = $this->createProposition("Giulio scrive a Matteo dopo un lungo viaggio.", true, $questionnaire_3_1_1);
        $questionnaire_3_1_1_2 = $this->createProposition("Giulio racconta che l’aereo è arrivato in ritardo.", false, $questionnaire_3_1_1);
        $questionnaire_3_1_1_3 = $this->createProposition("Giulio visiterà la città accompagnato da una nuova amica.", true, $questionnaire_3_1_1);
        $questionnaire_3_1_1_4 = $this->createProposition("Giulio ha iniziato uno stage.", false, $questionnaire_3_1_1);

        /*******************************************
                    QUESTIONNAIRE 4 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_4 = $this->createQuestionnaire("A1_CE_services_bibliotheque", "A1", "CE", $test);
        $questionnaire_4->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_4->setMediaContext($this->mediaText("", "Avviso in biblioteca", ""));
        $questionnaire_4->setMediaText($this->mediaText("Orari e servizi della biblioteca", "A1_CE_services_bibliotheque", "image"));

        // CREATION QUESTION
        $questionnaire_4_1 = $this->createQuestion("TVF", $questionnaire_4);
        // CREATION SUBQUESTION
        //$questionnaire_4_1_1 = $this->createSubquestion("QRM", $questionnaire_4_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_4_1_1_1 = $this->createProposition("La biblioteca chiude per la pausa pranzo", true, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_2 = $this->createProposition("La biblioteca č aperta tutte le mattine.", false, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_3 = $this->createProposition("In biblioteca č possibile navigare su internet senza pagare.", true, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_4 = $this->createProposition("XXXXXXXXXXXXXXXXXX", true, $questionnaire_4_1_1);

        $questionnaire_4_1_1 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "La biblioteca chiude per la pausa pranzo");
        $questionnaire_4_1_2 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "La biblioteca č aperta tutte le mattine.");
        $questionnaire_4_1_3 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "In biblioteca č possibile navigare su internet senza pagare.");
        $questionnaire_4_1_4 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "Non è permesso restare in biblioteca a studiare");
        // CREATION PROPOSITIONS
        $questionnaire_4_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_4_1_1);
        $questionnaire_4_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_4_1_1);

        $questionnaire_4_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_4_1_2);
        $questionnaire_4_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_4_1_2);

        $questionnaire_4_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_4_1_3);
        $questionnaire_4_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_4_1_3);

        $questionnaire_4_1_1_4 = $this->createPropositionVF("", "VRAI", false, $questionnaire_4_1_4);
        $questionnaire_4_1_1_4 = $this->createPropositionVF("", "FAUX", true, $questionnaire_4_1_4);


        /*******************************************
                    QUESTIONNAIRE 5 : n'existe pas
        ********************************************/

        /*******************************************
                    QUESTIONNAIRE 6 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_6 = $this->createQuestionnaire("A1_CE_cours_bibliotheque", "A1", "CE", $test);
        $questionnaire_6->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta", ""));
        $questionnaire_6->setMediaContext($this->mediaText("", "Brochure informativa in biblioteca", ""));
        $questionnaire_6->setMediaText($this->mediaText("I corsi della Società per la biblioteca circolante", "A1_CE_cours_bibliotheque", "image"));
        // CREATION QUESTION
        $questionnaire_6_1 = $this->createQuestion("TQRU", $questionnaire_6);
        // CREATION SUBQUESTION
        $questionnaire_6_1_1 = $this->createSubquestion("QRU", $questionnaire_6_1, "1.I corsi dell’associazione sono");
        $questionnaire_6_1_2 = $this->createSubquestion("QRU", $questionnaire_6_1, "2. L’Associazione:");
        $questionnaire_6_1_3 = $this->createSubquestion("QRU", $questionnaire_6_1, "3. Per iscriversi all’Associazione:");
        // CREATION PROPOSITIONS
        $questionnaire_6_1_1_1 = $this->createProposition("rivolti agli anziani.", false, $questionnaire_6_1_1);
        $questionnaire_6_1_1_2 = $this->createProposition("aperti a tutti.", false, $questionnaire_6_1_1);
        $questionnaire_6_1_1_3 = $this->createProposition("solo per i soci.", true, $questionnaire_6_1_1);

        $questionnaire_6_1_2_1 = $this->createProposition("Offre solo corsi di lingua.", false, $questionnaire_6_1_2);
        $questionnaire_6_1_2_2 = $this->createProposition("Offre corsi di lingua e informatica.", false, $questionnaire_6_1_2);
        $questionnaire_6_1_2_3 = $this->createProposition("Offre corsi di vario tipo.", true, $questionnaire_6_1_2);

        $questionnaire_6_1_3_1 = $this->createProposition("Non si paga nulla", false, $questionnaire_6_1_3);
        $questionnaire_6_1_3_2 = $this->createProposition("Bisogna pagare una piccola somma", true, $questionnaire_6_1_3);
        $questionnaire_6_1_3_3 = $this->createProposition("Bisogna presentarsi il primo giorno dell’anno", false, $questionnaire_6_1_3);

        /*******************************************
                    QUESTIONNAIRE 7 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_7 = $this->createQuestionnaire("A1_CE_ticket_SMS", "A1", "CE", $test);
        $questionnaire_7->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta", ""));
        $questionnaire_7->setMediaContext($this->mediaText("", "Brochure informativa sui servizi in autobus", ""));
        $questionnaire_7->setMediaText($this->mediaText("", "A1_CE_ticket_SMS", "image"));
        // CREATION QUESTION
        $questionnaire_7_1 = $this->createQuestion("QRU", $questionnaire_7);
        // CREATION SUBQUESTION
        $questionnaire_7_1_1 = $this->createSubquestion("QRU", $questionnaire_7_1, "Il servizio permette di");

        // CREATION PROPOSITIONS
        $questionnaire_7_1_1_1 = $this->createProposition("avere informazioni sul traffico.", false, $questionnaire_7_1_1);
        $questionnaire_7_1_1_2 = $this->createProposition("comprare il biglietto con il cellulare.", true, $questionnaire_7_1_1);
        $questionnaire_7_1_1_3 = $this->createProposition("conoscere gli orari dell’autobus.", false, $questionnaire_7_1_1);

        /*******************************************
                    QUESTIONNAIRE 8 : n'existe pas
        ********************************************/

        /*******************************************
                    QUESTIONNAIRE 9 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_9 = $this->createQuestionnaire("A1_CE_train_enfants", "A1", "CE", $test);
        $questionnaire_9->setMediaInstruction($this->mediaText("", "Quale informazione č presente nel testo?", ""));
        $questionnaire_9->setMediaContext($this->mediaText("", "Pubblicitŕ informativa in stazione", ""));
        $questionnaire_9->setMediaText($this->mediaText("Su Italo i bambini fino a 4 anni viaggiano gratuitamente  e devono essere accompagnati da  un adulto. Quelli dai 5 ai 14 anni possono viaggiare da soli ma  i genitori devono richiedere il Servizio Hostess. Per i ragazzi dai 15 anni ai 18 anni sono previsti ottimi sconti sulle offerte Base ed Economy.
", "Su Italo grandi vantaggi per i piccoli!", ""));
        // CREATION QUESTION
        $questionnaire_9_1 = $this->createQuestion("QRU", $questionnaire_9);
        // CREATION SUBQUESTION
        $questionnaire_9_1_1 = $this->createSubquestion("QRU", $questionnaire_9_1, "Il servizio permette di");

        // CREATION PROPOSITIONS
        $questionnaire_9_1_1_1 = $this->createProposition("I bambini che hanno meno di quattro anni non devono pagare il biglietto.", true, $questionnaire_9_1_1);
        $questionnaire_9_1_1_2 = $this->createProposition("Il Servizio Hostess č incluso nel prezzo del biglietto.", false, $questionnaire_9_1_1);
        $questionnaire_9_1_1_3 = $this->createProposition("Comprare il biglietto su internet permette di avere ottimi sconti.", false, $questionnaire_9_1_1);

        /*******************************************
                    QUESTIONNAIRE 10 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_10 = $this->createQuestionnaire("A1_CE_SMS_pizza", "A1", "CE", $test);
        $questionnaire_10->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta č corretta", ""));
        $questionnaire_10->setMediaContext($this->mediaText("", "SMS tra madre e figlia", ""));
        $questionnaire_10->setMediaText($this->mediaText("", "Mamma, stasera non ci sono, vado a mangiare la pizza con Paolo. Tranquilla non faccio tardi, lo so che domani cč scuola, torno verso le 1**1.**30. A dopo, Francy", ""));
        // CREATION QUESTION
        $questionnaire_10_1 = $this->createQuestion("TQRU", $questionnaire_10);
        // CREATION SUBQUESTION
        $questionnaire_10_1_1 = $this->createSubquestion("QRU", $questionnaire_10_1, "1.Francesca esce con Paolo per:");
        $questionnaire_10_1_2 = $this->createSubquestion("QRU", $questionnaire_10_1, "2. Domani Francesca:");
        // CREATION PROPOSITIONS
        $questionnaire_10_1_1_1 = $this->createProposition("cena", true, $questionnaire_10_1_1);
        $questionnaire_10_1_1_2 = $this->createProposition("apranzo", false, $questionnaire_10_1_1);
        $questionnaire_10_1_1_3 = $this->createProposition("merenda", false, $questionnaire_10_1_1);

        $questionnaire_10_1_2_1 = $this->createProposition("č in vacanza.", false, $questionnaire_10_1_2);
        $questionnaire_10_1_2_2 = $this->createProposition("deve andare a scuola.", true, $questionnaire_10_1_2);
        $questionnaire_10_1_2_3 = $this->createProposition("esce con Paolo.", false, $questionnaire_10_1_2);

        /*******************************************
                    QUESTIONNAIRE 11 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_11 = $this->createQuestionnaire("A1_CE_mail_vacances", "A1", "CE", $test);
        $questionnaire_11->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_11->setMediaContext($this->mediaText("", "E-mail tra padre e figlio", ""));
        $questionnaire_11->setMediaText($this->mediaText("Qui tutto bene!", "Ciao papà,@@@le vacanze procedono benissimo! La mattina faccio sempre colazione al bar e poi vado in spiaggia fino all’ora di pranzo. Nel pomeriggio sto in camera a leggere e a riposarmi e poi la sera, verso le 7.00, vado a correre e dopo cena esco con dei ragazzi simpatici che ho conosciuto qui. Spero tutto bene lì a casa!! @@@Un abbraccio e a presto, Giulio", ""));
        // CREATION QUESTION
        $questionnaire_11_1 = $this->createQuestion("QRM", $questionnaire_11);
        // CREATION SUBQUESTION
        $questionnaire_11_1_1 = $this->createSubquestion("QRM", $questionnaire_11_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_11_1_1_1 = $this->createProposition("Giulio č in vacanza al mare.", true, $questionnaire_11_1_1);
        $questionnaire_11_1_1_2 = $this->createProposition("Giulio la mattina prende il cappuccino", false, $questionnaire_11_1_1);
        $questionnaire_11_1_1_3 = $this->createProposition("Giulio dopo pranzo controlla le sue mail.", false, $questionnaire_11_1_1);
        $questionnaire_11_1_1_4 = $this->createProposition("Giulio ha trovato dei nuovi amici in vacanza.", true, $questionnaire_11_1_1);

        /*******************************************
                    QUESTIONNAIRE 12 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_12 = $this->createQuestionnaire("A1_CE_cours_prives_science", "A1", "CE", $test);
        $questionnaire_12->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_12->setMediaContext($this->mediaText("", "Annuncio all’università", ""));
        $questionnaire_12->setMediaText($this->mediaText("Lezioni private", "Hai problemi con la matematica? Non capisci la fisica? Non dormi prima dell’esame di chimica? Stai tranquillo!! C’è chi può aiutarti!! Sono disponibile per lezioni private e preparazione agli esami. Chiamami al 345 6756433,  oppure scrivi al mio indirizzo mail:@@@ fabrizio.sos-esami@hotmail.it.", ""));
        // CREATION QUESTION
        $questionnaire_12_1 = $this->createQuestion("TVF", $questionnaire_12);
        // CREATION SUBQUESTION
        //$questionnaire_12_1_1 = $this->createSubquestion("QRM", $questionnaire_12_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_12_1_1_1 = $this->createProposition("Lannuncio č rivolto agli studenti che hanno problemi con le materie letterarie.", false, $questionnaire_12_1_1);
        //$questionnaire_12_1_1_2 = $this->createProposition("Lannuncio pubblicizza i servizi di una scuola.", false, $questionnaire_12_1_1);
        //$questionnaire_12_1_1_3 = $this->createProposition("Fabrizio propone lezioni individuali.", true, $questionnaire_12_1_1);


        // CREATION SUBQUESTION
        $questionnaire_12_1_1 = $this->createSubquestionVF("VF", $questionnaire_12_1, "", "L’annuncio è rivolto agli studenti che hanno problemi con le materie letterarie.");
        $questionnaire_12_1_2 = $this->createSubquestionVF("VF", $questionnaire_12_1, "", "DL’annuncio pubblicizza i servizi di una scuola.");
        $questionnaire_12_1_3 = $this->createSubquestionVF("VF", $questionnaire_12_1, "", "Fabrizio propone lezioni individuali.");
        // CREATION PROPOSITIONS
        $questionnaire_12_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_12_1_1);
        $questionnaire_12_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_12_1_1);

        $questionnaire_12_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_12_1_2);
        $questionnaire_12_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_12_1_2);

        $questionnaire_12_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_12_1_3);
        $questionnaire_12_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_12_1_3);


        /*******************************************
                    QUESTIONNAIRE 13 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_13 = $this->createQuestionnaire("A1_CE_livres_universite", "A1", "CE", $test);
        $questionnaire_13->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_13->setMediaContext($this->mediaText("", "Annuncio all’università", ""));
        $questionnaire_13->setMediaText($this->mediaText("Vendita libri usati", "Vendo libri usati per gli studenti del I anno di Letteratura italiana. I libri sono come nuovi, prezzo da stabilire. Offro in regalo le fotocopie distribuite durante il corso.@@@Per informazioni chiamare il 329 6753123", ""));
        // CREATION QUESTION
        $questionnaire_13_1 = $this->createQuestion("QRM", $questionnaire_13);
        // CREATION SUBQUESTION
        $questionnaire_13_1_1 = $this->createSubquestion("QRM", $questionnaire_13_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_13_1_1_1 = $this->createProposition("L’annuncio è rivolto a studenti che cercano libri.", true, $questionnaire_13_1_1);
        $questionnaire_13_1_1_2 = $this->createProposition("I libri sono venduti a metà prezzo.", false, $questionnaire_13_1_1);
        $questionnaire_13_1_1_3 = $this->createProposition("Chi compra i libri non deve pagare le fotocopie del corso.", true, $questionnaire_13_1_1);

        /*******************************************
                    QUESTIONNAIRE 14 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_14 = $this->createQuestionnaire("A1_CE_soldes_ete", "A1", "CE", $test);
        $questionnaire_14->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta", ""));
        $questionnaire_14->setMediaContext($this->mediaText("", "Pubblicità in un negozio di abbigliamento", ""));
        $questionnaire_14->setMediaText($this->mediaText("Sconti di stagione","Dal 1° luglio al 30 agosto grandi sconti su tutti i capi d’abbigliamento. Pantaloni e giacche al 40%, gonne e vestiti fino al 60% e tutti i costumi da bagno al 50%. Per i clienti che hanno la carta fedeltà, in regalo una borsa da spiaggia. Venite a trovarci, dal lunedì al sabato dalle 9 alle 19. Siamo aperti anche la prima domenica del mese.", ""));
        // CREATION QUESTION
        $questionnaire_14_1 = $this->createQuestion("TQRU", $questionnaire_14);
        // CREATION SUBQUESTION
        $questionnaire_14_1_1 = $this->createSubquestion("QRU", $questionnaire_14_1, "1. Il messaggio pubblicizza gli sconti:");
        $questionnaire_14_1_2 = $this->createSubquestion("QRU", $questionnaire_14_1, "2. I clienti con la carta fedeltà hanno diritto a:");
        $questionnaire_14_1_3 = $this->createSubquestion("QRU", $questionnaire_14_1, "3. Il negozio è aperto la domenica:");
        // CREATION PROPOSITIONS
        $questionnaire_14_1_1_1 = $this->createProposition("estivi", true, $questionnaire_14_1_1);
        $questionnaire_14_1_1_2 = $this->createProposition("invernali", false, $questionnaire_14_1_1);
        $questionnaire_14_1_1_3 = $this->createProposition("primaverili", false, $questionnaire_14_1_1);

        $questionnaire_14_1_2_1 = $this->createProposition("uno sconto ulteriore", false, $questionnaire_14_1_2);
        $questionnaire_14_1_2_2 = $this->createProposition("un oggetto in regalo", true, $questionnaire_14_1_2);
        $questionnaire_14_1_2_3 = $this->createProposition("punti extra per le prossime spese", false, $questionnaire_14_1_2);

        $questionnaire_14_1_3_1 = $this->createProposition("una volta al mese", true, $questionnaire_14_1_3);
        $questionnaire_14_1_3_2 = $this->createProposition("due volte al mese", false, $questionnaire_14_1_3);
        $questionnaire_14_1_3_3 = $this->createProposition("sempre", false, $questionnaire_14_1_3);

        /*******************************************
                    QUESTIONNAIRE 15 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_15 = $this->createQuestionnaire("A1_CE_competitions_campus", "A1", "CE", $test);
        $questionnaire_15->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_15->setMediaContext($this->mediaText("", "E-mail ad un amico", ""));
        $questionnaire_15->setMediaText($this->mediaText("Gare di atletica", "Ciao Luca,@@@sono stanchissimo ma ho trovato le energie per scriverti. @@@Oggi, qui al campus sono iniziate le gare di atletica: che emozione! Io ho fatto i 100 metri e sono arrivato 3°! Sono tanto contento perché mi sono classificato tra i primi tre e domani posso correre di nuovo.@@@Laura fa la maratona domani, è andata a letto molto presto stasera. Domani ti racconto come va. @@@Ciao ciao, buona notte.@@@Riccardo", ""));
        // CREATION QUESTION
        $questionnaire_15_1 = $this->createQuestion("TVF", $questionnaire_15);
        // CREATION SUBQUESTION
        //$questionnaire_15_1_1 = $this->createSubquestion("TVF", $questionnaire_15_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_15_1_1_1 = $this->createProposition("Al campus sono iniziate le competizioni sportive.", true, $questionnaire_15_1_1);
        //$questionnaire_15_1_1_2 = $this->createProposition("Riccardo ha finito le sue gare.", false, $questionnaire_15_1_1);
        //$questionnaire_15_1_1_3 = $this->createProposition("Laura ha dormito tutto il pomeriggio.", false, $questionnaire_15_1_1);

        // CREATION SUBQUESTION
        $questionnaire_15_1_1 = $this->createSubquestionVF("VF", $questionnaire_15_1, "", "Al campus sono iniziate le competizioni sportive.");
        $questionnaire_15_1_2 = $this->createSubquestionVF("VF", $questionnaire_15_1, "", "Riccardo ha finito le sue gare.");
        $questionnaire_15_1_3 = $this->createSubquestionVF("VF", $questionnaire_15_1, "", "Laura ha dormito tutto il pomeriggio.");
        // CREATION PROPOSITIONS
        $questionnaire_15_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_15_1_1);
        $questionnaire_15_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_15_1_1);

        $questionnaire_15_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_15_1_2);
        $questionnaire_15_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_15_1_2);

        $questionnaire_15_1_1_3 = $this->createPropositionVF("", "VRAI", false, $questionnaire_15_1_3);
        $questionnaire_15_1_1_3 = $this->createPropositionVF("", "FAUX", true, $questionnaire_15_1_3);

        /*******************************************
                    QUESTIONNAIRE 16 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_16 = $this->createQuestionnaire("A1_CE_nouvelles_londres", "A1", "CE", $test);
        $questionnaire_16->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_16->setMediaContext($this->mediaText("", "E-mail ad un amico", ""));
        $questionnaire_16->setMediaText($this->mediaText("Notizie da Londra", "Ciao Luca, scusa il ritardo ma** 1.** _______ancora abituarmi ai ritmi della nuova vita. @@@ Sai dove vivo adesso? Sono a Londra e finalmente posso fare il lavoro dei miei sogni! @@@Lavoro come stilista per una grande marca.** 2.** ________ assolutamente venire a trovarmi!@@@In questa cittŕ **3.** ________ fare davvero quello che ti piace.
I miei genitori ancora non sanno che ho una ragazza, incredibile vero? @@@Adesso **4.**_______ andare! Ciao@@@Giovanni @@@P. S. Dobbiamo sentirci piů spesso!", ""));
        // CREATION QUESTION
        $questionnaire_16_1 = $this->createQuestion("TQRU", $questionnaire_16);
        // CREATION SUBQUESTION
        $questionnaire_16_1_1 = $this->createSubquestion("QRU", $questionnaire_16_1, ""); // Partie vide, vu avec Francesca. 04/04/2014.
        $questionnaire_16_1_2 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        $questionnaire_16_1_3 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        $questionnaire_16_1_4 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_16_1_1_1 = $this->createProposition("1.1. devo", true, $questionnaire_16_1_1);
        $questionnaire_16_1_1_2 = $this->createProposition("1.2. posso", false, $questionnaire_16_1_1);
        $questionnaire_16_1_1_3 = $this->createProposition("1.3. voglio", false, $questionnaire_16_1_1);

        $questionnaire_16_1_2_1 = $this->createProposition("2.1. devi", true, $questionnaire_16_1_2);
        $questionnaire_16_1_2_2 = $this->createProposition("2.2. puoi", false, $questionnaire_16_1_2);
        $questionnaire_16_1_2_3 = $this->createProposition("2.3. vuoi", false, $questionnaire_16_1_2);

        $questionnaire_16_1_3_1 = $this->createProposition("3.1. devi", false, $questionnaire_16_1_3);
        $questionnaire_16_1_3_2 = $this->createProposition("3.2. puoi", true, $questionnaire_16_1_3);
        $questionnaire_16_1_3_3 = $this->createProposition("3.3. vuoi", false, $questionnaire_16_1_3);

        $questionnaire_16_1_4_1 = $this->createProposition("4.1. devo", true, $questionnaire_16_1_4);
        $questionnaire_16_1_4_2 = $this->createProposition("4.2. posso", false, $questionnaire_16_1_4);
        $questionnaire_16_1_4_3 = $this->createProposition("4.3. voglio", false, $questionnaire_16_1_4);

        /*******************************************
                    QUESTIONNAIRE 17 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_17 = $this->createQuestionnaire("A1_CE_indications_route", "A1", "CE", $test);
        $questionnaire_17->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_17->setMediaContext($this->mediaText("", "Post-it ad un’amica", ""));
        $questionnaire_17->setMediaText($this->mediaText("", "Ciao Sara,@@@io esco, ci vediamo direttamente a casa di Giorgio, ci vogliono due minuti a piedi. La festa inizia alle 10.00, non arrivare tardi come sempre! È facilissimo: attraversa la strada e continua dritto fino a piazza Verdi, poi quando arrivi al supermercato all’angolo prendi la seconda a sinistra, non puoi sbagliare, perché trovi il Bar Sport. Dopo gira subito a destra e trovi la sua casa accanto al panificio. Suona al campanello Rossi. @@@A stasera,@@@Lucia", ""));
        // CREATION QUESTION
        $questionnaire_17_1 = $this->createQuestion("TVF", $questionnaire_17);
        // CREATION SUBQUESTION
        //$questionnaire_17_1_1 = $this->createSubquestion("QRM", $questionnaire_17_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_17_1_1_1 = $this->createProposition("La casa di Giorgio è lontana da quella di Lucia e Sara", false, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_2 = $this->createProposition("Per andare alla festa Sara deve prendere il tram", false, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_3 = $this->createProposition("Il Bar Sport si trova dopo piazza Verdi", true, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_4 = $this->createProposition("La casa di Giorgio si trova al lato del panificio", true, $questionnaire_17_1_1);

        // CREATION SUBQUESTION
        $questionnaire_17_1_1 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "La casa di Giorgio è lontana da quella di Lucia e Sara");
        $questionnaire_17_1_2 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "Per andare alla festa Sara deve prendere il tram");
        $questionnaire_17_1_3 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "Il Bar Sport si trova dopo piazza Verdi");
        $questionnaire_17_1_4 = $this->createSubquestionVF("VF", $questionnaire_17_1, "", "La casa di Giorgio si trova al lato del panificio");
        // CREATION PROPOSITIONS
        $questionnaire_17_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_17_1_1);
        $questionnaire_17_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_17_1_1);

        $questionnaire_17_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_17_1_2);
        $questionnaire_17_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_17_1_2);

        $questionnaire_17_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_17_1_3);
        $questionnaire_17_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_17_1_3);

        $questionnaire_17_1_1_4 = $this->createPropositionVF("", "VRAI", true, $questionnaire_17_1_4);
        $questionnaire_17_1_1_4 = $this->createPropositionVF("", "FAUX", false, $questionnaire_17_1_4);

        /*******************************************
                    QUESTIONNAIRE 18 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_18 = $this->createQuestionnaire("A1_CE_shopping_florence_2_2", "A1", "CE", $test);
        $questionnaire_18->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_18->setMediaContext($this->mediaText("", "Breve articolo su rivista femminile", ""));
        $questionnaire_18->setMediaText($this->mediaText("Le vie dello shopping a Firenze", "Sempre **1.** ____ pieno centro per uno shopping più alla portata dei giovani segnaliamo Via dei Calzaioli, **2.** ______ potrete trovare negozi sportivi, grandi catene commerciali e anche, per la felicità dei più piccoli tanti negozi **3.** ____ giocattoli.", ""));
        // CREATION QUESTION
        $questionnaire_18_1 = $this->createQuestion("TQRU", $questionnaire_18);
        // CREATION SUBQUESTION
        $questionnaire_18_1_1 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_2 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_3 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_18_1_1_1 = $this->createProposition("1.1. dal", false, $questionnaire_18_1_1);
        $questionnaire_18_1_1_2 = $this->createProposition("1.2. in", true, $questionnaire_18_1_1);
        $questionnaire_18_1_1_3 = $this->createProposition("1.3. sul ", false, $questionnaire_18_1_1);

        $questionnaire_18_1_2_1 = $this->createProposition("2.1. quando", false, $questionnaire_18_1_2);
        $questionnaire_18_1_2_2 = $this->createProposition("2.2. come", false, $questionnaire_18_1_2);
        $questionnaire_18_1_2_3 = $this->createProposition("2.3. dove ", true, $questionnaire_18_1_2);

        $questionnaire_18_1_3_1 = $this->createProposition("3.1. di", true, $questionnaire_18_1_3);
        $questionnaire_18_1_3_2 = $this->createProposition("3.2. a", false, $questionnaire_18_1_3);
        $questionnaire_18_1_3_3 = $this->createProposition("3.3. da", false, $questionnaire_18_1_3);

        /*******************************************
                    QUESTIONNAIRE 19 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_19 = $this->createQuestionnaire("A1_CE_agenda_anita", "A1", "CE", $test);
        $questionnaire_19->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_19->setMediaContext($this->mediaText("", "L’agenda di Anita", ""));
        $questionnaire_19->setMediaText($this->mediaText("Appuntamenti della settimana", "Le tableau vous sera donner dans un dossier  à part", ""));
        // CREATION QUESTION
        $questionnaire_19_1 = $this->createQuestion("TVF", $questionnaire_19);
        // CREATION SUBQUESTION
        //$questionnaire_19_1_1 = $this->createSubquestion("QRM", $questionnaire_19_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_19_1_1_1 = $this->createProposition("Anita esce spesso con Luca.", false, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_2 = $this->createProposition("Anita non va mai a correre.", true, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_3 = $this->createProposition("Le lezioni di Anita sono quasi sempre la mattina.", true, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_4 = $this->createProposition("Anita vede i genitori durante la settimana", false, $questionnaire_19_1_1);
        //$questionnaire_19_1_1_1 = $this->createProposition("Anita lavora solo la sera.", false, $questionnaire_19_1_1);

        // CREATION SUBQUESTION
        $questionnaire_19_1_1 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita esce spesso con Luca.");
        $questionnaire_19_1_2 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita non va mai a correre.");
        $questionnaire_19_1_3 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Le lezioni di Anita sono quasi sempre la mattina.");
        $questionnaire_19_1_4 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita vede i genitori durante la settimana");
        $questionnaire_19_1_5 = $this->createSubquestionVF("VF", $questionnaire_19_1, "", "Anita lavora solo la sera.");

        // CREATION PROPOSITIONS
        $questionnaire_19_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_19_1_1);
        $questionnaire_19_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_19_1_1);

        $questionnaire_19_1_1_2 = $this->createPropositionVF("", "VRAI", true, $questionnaire_19_1_2);
        $questionnaire_19_1_1_2 = $this->createPropositionVF("", "FAUX", false, $questionnaire_19_1_2);

        $questionnaire_19_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_19_1_3);
        $questionnaire_19_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_19_1_3);

        $questionnaire_19_1_1_4 = $this->createPropositionVF("", "VRAI", false, $questionnaire_19_1_4);
        $questionnaire_19_1_1_4 = $this->createPropositionVF("", "FAUX", true, $questionnaire_19_1_4);

        $questionnaire_19_1_1_5 = $this->createPropositionVF("", "VRAI", false, $questionnaire_19_1_5);
        $questionnaire_19_1_1_5 = $this->createPropositionVF("", "FAUX", true, $questionnaire_19_1_5);







        /*******************************************

                    NIVEAU : B1

        ********************************************/

        /*******************************************
                    QUESTIONNAIRE 3 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_3 = $this->createQuestionnaire("B1_CE_vacance_croisiere", "B1", "CE", $test);
        $questionnaire_3->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_3->setMediaContext($this->mediaText("", "Pubblicità in agenzia di viaggi", ""));
        $questionnaire_3->setMediaText($this->mediaText("Partire con ***Crociere nel Mondo***", "Sempre più persone scelgono ogni anno di trascorrere le proprie vacanze con Crociere nel Mondo; se deciderai di unirti a noi, capirai subito il perché. @@@
Il comfort e l’eccezionale servizio della nostra nave saprà come sorprenderti: ti innamorerai delle meravigliose SPA, degli spettacoli, dell’intrattenimento a bordo, dei numerosi sport che potrai praticare e delle delizie della nostra cucina. Apprezzerai anche il modo  in cui sappiamo intrattenere gli ospiti di tutte le età, ad un prezzo che continuerà a farti sorridere. Prova l’esperienza di un viaggio con noi, non vorrai più tornare a casa.
Sempre più persone scelgono ogni anno di trascorrere le proprie vacanze con Crociere nel Mondo; se deciderai di unirti a noi, capirai subito il perché. @@@
Il comfort e l’eccezionale servizio della nostra nave saprà come sorprenderti: ti innamorerai delle meravigliose SPA, degli spettacoli, dell’intrattenimento a bordo, dei numerosi sport che potrai praticare e delle delizie della nostra cucina. Apprezzerai anche il modo  in cui sappiamo intrattenere gli ospiti di tutte le età, ad un prezzo che continuerà a farti sorridere. Prova l’esperienza di un viaggio con noi, non vorrai più tornare a casa.", ""));
        // CREATION QUESTION
        $questionnaire_3_1 = $this->createQuestion("QRM", $questionnaire_3);
        // CREATION SUBQUESTION
        $questionnaire_3_1_1 = $this->createSubquestion("QRM", $questionnaire_3_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_3_1_1_1 = $this->createProposition("Con Crociere nel Mondo puoi continuare a fare gli sport che ti  piacciono anche in vacanza.", true, $questionnaire_3_1_1);
        $questionnaire_3_1_1_2 = $this->createProposition("Il punto di forza dell’azienda è la capacità di offrire servizi per  tutte le esigenze.", true, $questionnaire_3_1_1);
        $questionnaire_3_1_1_3 = $this->createProposition("L’offerta è accessibile ad un pubblico ristretto", false, $questionnaire_3_1_1);


        /*******************************************
                    QUESTIONNAIRE 4 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_4 = $this->createQuestionnaire("B1_CE_voyager_en_securite", "B1", "CE", $test);
        $questionnaire_4->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_4->setMediaContext($this->mediaText("", "Avviso sul sito del Ministero degli Esteri", ""));
        $questionnaire_4->setMediaText($this->mediaText("Viaggiare sicuri", "Sono stati di recente segnalati casi di false società che, attraverso la rete, propongono servizi di prenotazione alberghiera, in particolare per le regioni del sud del Portogallo. Per evitare di pagare un servizio e  avere poi brutte sorprese, si raccomanda quindi, di rivolgersi esclusivamente ad agenzie e a tour operator affidabili.@@@
Si consiglia inoltre di registrare i dati relativi al viaggio che si intende effettuare sul sito Dove siamo nel mondo e di sottoscrivere una assicurazione che copra anche le spese sanitarie, e l’eventuale trasferimento aereo al paese d’origine in caso di malattie gravi.
Sono stati di recente segnalati casi di false società che, attraverso la rete, propongono servizi di prenotazione alberghiera, in particolare per le regioni del sud del Portogallo. Per evitare di pagare un servizio e  avere poi brutte sorprese, si raccomanda quindi, di rivolgersi esclusivamente ad agenzie e a tour operator affidabili.@@@
Si consiglia inoltre di registrare i dati relativi al viaggio che si intende effettuare sul sito Dove siamo nel mondo e di sottoscrivere una assicurazione che copra anche le spese sanitarie, e l’eventuale trasferimento aereo al paese d’origine in caso di malattie gravi.
", ""));
        // CREATION QUESTION
        $questionnaire_4_1 = $this->createQuestion("TVF", $questionnaire_4);
        // CREATION SUBQUESTION
        //$questionnaire_4_1_1 = $this->createSubquestion("QRM", $questionnaire_4_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_4_1_1_1 = $this->createProposition("Il messaggio intende mettere in guardia i turisti da siti internet poco sicuri.", true, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_2 = $this->createProposition("Nel messaggio si consiglia di contattare le società di prenotazione alberghiera una volta arrivati sul posto.", false, $questionnaire_4_1_1);
        //$questionnaire_4_1_1_3 = $this->createProposition("Prima di partire è obbligatorio acquistare un'assicurazione per le spese mediche.", false, $questionnaire_4_1_1);

        // CREATION SUBQUESTION
        $questionnaire_4_1_1 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "Il messaggio intende mettere in guardia i turisti da siti internet poco sicuri.");
        $questionnaire_4_1_2 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "Nel messaggio si consiglia di contattare le società di prenotazione alberghiera una volta arrivati sul posto.");
        $questionnaire_4_1_3 = $this->createSubquestionVF("VF", $questionnaire_4_1, "", "Prima di partire è obbligatorio acquistare un'assicurazione per le spese mediche.");

        // CREATION PROPOSITIONS
        $questionnaire_4_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_4_1_1);
        $questionnaire_4_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_4_1_1);

        $questionnaire_4_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_4_1_2);
        $questionnaire_4_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_4_1_2);

        $questionnaire_4_1_1_3 = $this->createPropositionVF("", "VRAI", false, $questionnaire_4_1_3);
        $questionnaire_4_1_1_3 = $this->createPropositionVF("", "FAUX", true, $questionnaire_4_1_3);



        /*******************************************
                    QUESTIONNAIRE 6 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_6 = $this->createQuestionnaire("B1_CE_annonce_immobilier", "B1", "CE", $test);
        $questionnaire_6->setMediaInstruction($this->mediaText("", "Due informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_6->setMediaContext($this->mediaText("", "Annuncio immobiliare", ""));
        $questionnaire_6->setMediaText($this->mediaText("Affittasi appartamento al Marina Village", "All'interno del Marina Village, vera oasi di pace sul trasparente mare Ionio, proponiamo in affitto splendido appartamento con 6 posti letto, climatizzato e finemente arredato composto da un ampio soggiorno con zona cottura, un bagno e un ampio balcone con una splendida vista sul mare. La cura dei dettagli ed il contesto donano alla casa un tocco di stile ed un'eleganza esclusiva. Il villaggio turistico offre intrattenimento serale per tutti. La spiaggia privata è raggiungibile solo attraverso un breve percorso a piedi o in bicicletta.", ""));
        // CREATION QUESTION
        $questionnaire_6_1 = $this->createQuestion("QRM", $questionnaire_6);
        // CREATION SUBQUESTION
        $questionnaire_6_1_1 = $this->createSubquestion("QRM", $questionnaire_6_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_6_1_1_1 = $this->createProposition("Al villaggio turistico Marina Village propongono animazione serale.", true, $questionnaire_6_1_1);
        $questionnaire_6_1_1_2 = $this->createProposition("L’appartamento dispone di 5 camere da letto.", false, $questionnaire_6_1_1);
        $questionnaire_6_1_1_3 = $this->createProposition("Il terrazzo è arredato con ombrelloni e sdraio.", false, $questionnaire_6_1_1);
        $questionnaire_6_1_1_4 = $this->createProposition("La spiaggia privata non è raggiungibile da veicoli a motore", true, $questionnaire_6_1_1);

        /*******************************************
                    QUESTIONNAIRE 7 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_7 = $this->createQuestionnaire("B1_CE_cours_pizzaiolo", "B1", "CE", $test);
        $questionnaire_7->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_7->setMediaContext($this->mediaText("", "Annuncio lavorativo", ""));
        $questionnaire_7->setMediaText($this->mediaText("Corso per pizzaiolo! Diventa pizzaiolo e impara un mestiere!
", "Sono aperte le iscrizioni al prossimo corso per 1.________________ pizzaiolo. Durata 13 giorni di pratica e teoria direttamente in pizzeria dal primo all’ultimo giorno di corso. Alla fine verrà rilasciato il nostro 2._________________ da pizzaiolo e l’iscrizione al nostro albo pizzaioli.
Il corso è a numero 3._________________. Riservato a 3 persone per volta. I nostri corsi sono riservati a poche persone per volta per darti la garanzia che sarai seguito bene!
I nostri orari sono flessibili, adatti anche a chi studia o lavora.
Per maggiori informazioni visita anche il nostro sito www.pizzaitalianaacademy.com", ""));
        // CREATION QUESTION
        $questionnaire_7_1 = $this->createQuestion("TQRU", $questionnaire_10);
        // CREATION SUBQUESTION
        $questionnaire_7_1_1 = $this->createSubquestion("QRU", $questionnaire_7_1, "");
        $questionnaire_7_1_2 = $this->createSubquestion("QRU", $questionnaire_7_1, "");
        $questionnaire_7_1_3 = $this->createSubquestion("QRU", $questionnaire_7_1, "");
        $questionnaire_7_1_4 = $this->createSubquestion("QRU", $questionnaire_7_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_7_1_1_1 = $this->createProposition("1.1. Lavorare", false, $questionnaire_7_1_1);
        $questionnaire_7_1_1_2 = $this->createProposition("1.2. Apprendere", false, $questionnaire_7_1_1);
        $questionnaire_7_1_1_3 = $this->createProposition("1.3. Diventare", true, $questionnaire_7_1_1);

        $questionnaire_7_1_2_1 = $this->createProposition("2.1. Diploma", true, $questionnaire_7_1_2);
        $questionnaire_7_1_2_2 = $this->createProposition("2.2. Documento", false, $questionnaire_7_1_2);
        $questionnaire_7_1_2_3 = $this->createProposition("2.3. Libretto", false, $questionnaire_7_1_2);

        $questionnaire_7_1_3_1 = $this->createProposition("3.1. Chiuso", true, $questionnaire_7_1_3);
        $questionnaire_7_1_3_2 = $this->createProposition("3.2. Stretto", false, $questionnaire_7_1_3);
        $questionnaire_7_1_3_3 = $this->createProposition("3.3 Corto", false, $questionnaire_7_1_3);

        $questionnaire_7_1_4_1 = $this->createProposition("4.1. Assicurazione", false, $questionnaire_7_1_4);
        $questionnaire_7_1_4_2 = $this->createProposition("4.2. Garanzia", true, $questionnaire_7_1_4);
        $questionnaire_7_1_4_3 = $this->createProposition("4.3. Celebrità", false, $questionnaire_7_1_4);

        /*******************************************
                    QUESTIONNAIRE 8 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_8 = $this->createQuestionnaire("B1_CE_evenements_rome", "B1", "CE", $test);
        $questionnaire_8->setMediaInstruction($this->mediaText("", "Seleziona il riassunto corretto", ""));
        $questionnaire_8->setMediaContext($this->mediaText("", "Brochure informativa a teatro", ""));
        $questionnaire_8->setMediaText(
        $this->mediaText(
            "Rappresentazioni ed eventi teatrali a Roma",
            "Arriva l’estate e ricomincia la stagione d’eventi proposta come ogni anno dall’associazione Fiesta. Nelle calde estati romane, l’associazione promuove il Festival Internazionale di Musica e Cultura Latino Americana. Gli eventi si terranno da giugno a settembre e  il calendario è già disponibile sul sito $$$$$$ per prenotazioni. Come ogni anno gli spettacoli si terranno nello splendido Parco Rosati.",
            ""));
        // CREATION QUESTION
        $questionnaire_8_1 = $this->createQuestion("TQRU", $questionnaire_8);
        // CREATION SUBQUESTION
        $questionnaire_8_1_1 = $this->createSubquestion("QRU", $questionnaire_8_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_8_1_1_1 = $this->createProposition("L’annuncio promuove gli eventi estivi organizzati dall’associazione ***Fiesta*** nel Parco Rosati. Per partecipare è necessario prenotare i biglietti sul sito internet.", true, $questionnaire_8_1_1);
        $questionnaire_8_1_1_2 = $this->createProposition("L’annuncio promuove i corsi estivi di ballo latino-americano dell’associazione ***Fiesta***. Per partecipare è necessario iscriversi presso la sede dell’associazione situata nel Parco Rosati.", false, $questionnaire_8_1_1);
        $questionnaire_8_1_1_3 = $this->createProposition("L’annuncio promuove i corsi estivi di lingua e cultura latino-americana tenuti presso l’associazione ***Fiesta***, situata nello splendido Parco Rosati.", false, $questionnaire_8_1_1);

        /*******************************************
                    QUESTIONNAIRE 9 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_9 = $this->createQuestionnaire("B1_CE_vacance_sicile", "B1", "CE", $test);
        $questionnaire_9->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_9->setMediaContext($this->mediaText("", "Pubblicità in un’agenzia di viaggi", ""));
        $questionnaire_9->setMediaText($this->mediaText("Alla scoperta della Sicilia",
        "Per quanti vogliono visitare la Sicilia e apprezzarne il patrimonio artistico, storico e naturalistico, Hermes-Sicily.com propone un programma di visite guidate settimanali. Si tratta di \"gruppi misti\" ai quali è possibile iscriversi scegliendo  le mete secondo il calendario stagionale previsto. I gruppi possono essere composti da massimo 10 partecipanti  e le iscrizioni possono essere singole o di gruppo. Oltre che in lingua italiana le visite, si tengono anche in inglese e tedesco.", ""));
        // CREATION QUESTION
        $questionnaire_9_1 = $this->createQuestion("TVF", $questionnaire_9);
        // CREATION SUBQUESTION
        //$questionnaire_9_1_1 = $this->createSubquestion("QRM", $questionnaire_9_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_9_1_1_1 = $this->createProposition("Le visite guidate si tengono una volta a settimana.", true, $questionnaire_9_1_1);
        //$questionnaire_9_1_1_2 = $this->createProposition("Le visite guidate cambiano in base alla stagione.", true, $questionnaire_9_1_1);
        //$questionnaire_9_1_1_3 = $this->createProposition("I gruppi devono essere composti da almeno 10 partecipanti.", false, $questionnaire_9_1_1);


        // CREATION SUBQUESTION
        $questionnaire_9_1_1 = $this->createSubquestionVF("VF", $questionnaire_9_1, "", "Le visite guidate si tengono una volta a settimana.");
        $questionnaire_9_1_2 = $this->createSubquestionVF("VF", $questionnaire_9_1, "", "Le visite guidate cambiano in base alla stagione.");
        $questionnaire_9_1_3 = $this->createSubquestionVF("VF", $questionnaire_9_1, "", "I gruppi devono essere composti da almeno 10 partecipanti.");

        // CREATION PROPOSITIONS
        $questionnaire_9_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_9_1_1);
        $questionnaire_9_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_9_1_1);

        $questionnaire_9_1_1_2 = $this->createPropositionVF("", "VRAI", true, $questionnaire_9_1_2);
        $questionnaire_9_1_1_2 = $this->createPropositionVF("", "FAUX", false, $questionnaire_9_1_2);

        $questionnaire_9_1_1_3 = $this->createPropositionVF("", "VRAI", false, $questionnaire_9_1_3);
        $questionnaire_9_1_1_3 = $this->createPropositionVF("", "FAUX", true, $questionnaire_9_1_3);

        /*******************************************
                    QUESTIONNAIRE 11 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B1_11 = $this->createQuestionnaire("B1_CE_chemin_compostelle", "B1", "CE", $test);
        $questionnaire_B1_11->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_B1_11->setMediaContext($this->mediaText("", "Post su blog di viaggi", ""));
        $questionnaire_B1_11->setMediaText($this->mediaText("Il cammino di Santiago",
        "È difficile scrivere di un’esperienza personale così profonda, bisognerebbe scavare nell’anima, per trovare le radici delle motivazioni che spingono a intraprendere questo viaggio, che inizia ancor prima di partire dalla tua storia, dal tuo modo di essere e di vivere. @@@
È facile invece elencare le persone incontrate, le storie ascoltate camminando, i pranzi e le cene in compagnia, i luoghi visitati, gli alberghi dove ho dormito. Ognuno meriterebbe di essere descritto e raccontato con dovizia di particolari, ma non basterebbe un libro. @@@
Ometterò quindi aspetti puramente pratici, concentrandomi sulle sensazioni che crescevano in me, mentre vivevo uno dei capitoli più belli della mia vita.", ""));
        // CREATION QUESTION
        $questionnaire_B1_11_1 = $this->createQuestion("TVF", $questionnaire_B1_11);
        // CREATION SUBQUESTION
        //$questionnaire_11_1_1 = $this->createSubquestion("QRM", $questionnaire_11_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_11_1_1_1 = $this->createProposition("Il racconto di viaggio descrive principalmente gli aspetti pratici dell’organizzazione.", false, $questionnaire_11_1_1);
        //$questionnaire_11_1_1_2 = $this->createProposition("L’autrice sostiene che sia complesso descrivere le forti emozioni provate durante il viaggio.   ", true, $questionnaire_11_1_1);
        //$questionnaire_11_1_1_3 = $this->createProposition("Per l’autrice i motivi che spronano a partire sono profondi, inconsci e forti.", true, $questionnaire_11_1_1);

        // CREATION SUBQUESTION
        $questionnaire_B1_11_1_1 = $this->createSubquestionVF("VF", $questionnaire_B1_11_1, "", "Il racconto di viaggio descrive principalmente gli aspetti pratici dell’organizzazione.");
        $questionnaire_B1_11_1_2 = $this->createSubquestionVF("VF", $questionnaire_B1_11_1, "", "L’autrice sostiene che sia complesso descrivere le forti emozioni provate durante il viaggio.");
        $questionnaire_B1_11_1_3 = $this->createSubquestionVF("VF", $questionnaire_B1_11_1, "", "Per l’autrice i motivi che spronano a partire sono profondi, inconsci e forti.");

        // CREATION PROPOSITIONS
        $questionnaire_B1_11_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_B1_11_1_1);
        $questionnaire_B1_11_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_B1_11_1_1);

        $questionnaire_B1_11_1_1_2 = $this->createPropositionVF("", "VRAI", true, $questionnaire_B1_11_1_2);
        $questionnaire_B1_11_1_1_2 = $this->createPropositionVF("", "FAUX", false, $questionnaire_B1_11_1_2);

        $questionnaire_B1_11_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_B1_11_1_3);
        $questionnaire_B1_11_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_B1_11_1_3);

        /*******************************************
                    QUESTIONNAIRE 13 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_13 = $this->createQuestionnaire("B1_CE_publicite_progres", "B1", "CE", $test);
        $questionnaire_13->setMediaInstruction($this->mediaText("", "Seleziona il riassunto corretto", ""));
        $questionnaire_13->setMediaContext($this->mediaText("", "Articolo su quotidiano", ""));
        $questionnaire_13->setMediaText($this->mediaText("Alfabetizzazione informatica",
        "Recenti ricerche dimostrano che gli italiani, tra tutti i cittadini d’Europa, si collocano agli ultimi posti in quanto a utilizzo del computer.
Il gruppo di lavoro di ***Pubblicità Progresso*** ha rilevato che il problema della scarsa propensione dei nostri connazionali a utilizzare il computer esiste ma bisogna evitare di drammatizzarlo. L’informatica non deve essere considerata una nuova religione ma un formidabile strumento che amplia le potenzialità degli individui. Per questo, l’obiettivo delle pubblicità che verranno mandate in onda prossimamente, è quello di lanciare un messaggio, privo di effetti speciali e allarmismi, che metta in rilievo l’utilità del computer nella vita quotidiana.", ""));

        // CREATION QUESTION
        $questionnaire_13_1 = $this->createQuestion("TQRU", $questionnaire_13);
        // CREATION SUBQUESTION
        $questionnaire_13_1_1 = $this->createSubquestion("QRU", $questionnaire_13_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_13_1_1_1 = $this->createProposition("***Pubblicità Progresso***, dopo aver constatato lo scarso utilizzo del computer da parte degli italiani, si è impegnata nella creazione di una campagna pubblicitaria chiara e semplice che promuova l’utilizzo e l’utilità di questo strumento.", true, $questionnaire_13_1_1);
        $questionnaire_13_1_1_2 = $this->createProposition("***Pubblicità Progresso***, dopo aver constatato che, nella società attuale l’informatica è diventata una sorta di religione, si è impegnata a lanciare una campagna pubblicitaria ad effetto che inviti ad un uso più moderato di questo strumento.", false, $questionnaire_13_1_1);
        $questionnaire_13_1_1_3 = $this->createProposition("***Pubblicità Progresso***, dopo aver constatato la drammatica situazione legata allo scarso utilizzo dei computer da parte dei cittadini italiani, si è impegnata nell’ideazione di una campagna promozionale di corsi di informatica.", false, $questionnaire_13_1_1);

        /*******************************************
                    QUESTIONNAIRE 14 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_14 = $this->createQuestionnaire("B1_CE_avis_parc_naturel", "B1", "CE", $test);
        $questionnaire_14->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_14->setMediaContext($this->mediaText("", "Avviso pubblico in un parco naturale", ""));
        $questionnaire_14->setMediaText($this->mediaText("Parco Naturale Amedeo Brenta: 3 regole per rispettare il parco",
        "1. Quando avvisti degli animali, tieniti a distanza: rischi di spaventarli. Hanno paura anche dei cani che, per questo, è necessario tenere sempre sotto controllo.@@@

2. Per salvaguardare il magico equilibrio del Parco, è vietato  il campeggio libero.@@@

3. Quasi ovunque si possono raccogliere i funghi, ma serve un permesso, che viene rilasciato dai Comuni.@@@
Queste semplici regole di buona educazione e buon senso vengono fatte rispettare dai guardaparco e dai forestali, anche applicando le sanzioni previste dalla L.P. 18/88.
Grazie per la collaborazione.", ""));
        // CREATION QUESTION
        $questionnaire_14_1 = $this->createQuestion("TVF", $questionnaire_14);
        // CREATION SUBQUESTION
        //$questionnaire_14_1_1 = $this->createSubquestion("QRM", $questionnaire_14_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_14_1_1_1 = $this->createProposition("Durante la visita al parco è obbligatorio tenere sempre sotto controllo i propri cani per evitare sanzioni da parte dei guardaparco e degli agenti forestali.", true, $questionnaire_11_1_1);
        //$questionnaire_14_1_1_2 = $this->createProposition("In tutte le aree del parco è concessa la raccolta dei funghi ai visitatori provvisti di permesso.", false, $questionnaire_11_1_1);
        //$questionnaire_14_1_1_3 = $this->createProposition("Per ragioni ambientali il campeggio nel parco non è permesso", true, $questionnaire_11_1_1);

        // CREATION SUBQUESTION
        $questionnaire_14_1_1 = $this->createSubquestionVF("VF", $questionnaire_14_1, "", "Durante la visita al parco è obbligatorio tenere sempre sotto controllo i propri cani per evitare sanzioni da parte dei guardaparco e degli agenti forestali.");
        $questionnaire_14_1_2 = $this->createSubquestionVF("VF", $questionnaire_14_1, "", "In tutte le aree del parco è concessa la raccolta dei funghi ai visitatori provvisti di permesso.");
        $questionnaire_14_1_3 = $this->createSubquestionVF("VF", $questionnaire_14_1, "", "Per ragioni ambientali il campeggio nel parco non è permesso");

        // CREATION PROPOSITIONS
        $questionnaire_14_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_14_1_1);
        $questionnaire_14_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_14_1_1);

        $questionnaire_14_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_14_1_2);
        $questionnaire_14_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_14_1_2);

        $questionnaire_14_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_14_1_3);
        $questionnaire_14_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_14_1_3);

        /*******************************************
                    QUESTIONNAIRE 15 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_15 = $this->createQuestionnaire("B1_CE_famille", "B1", "CE", $test);
        $questionnaire_15->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_15->setMediaContext($this->mediaText("", "Articolo su una rivista di attualità", ""));
        $questionnaire_15->setMediaText($this->mediaText("Le nuove famiglie", "La società italiana 1.__________________ e quindi il modello familiare si evolve. 2.________________ la famiglia è una istituzione sociale fondamentale che, negli ultimi anni, ha subito profondi cambiamenti e 3.________________________ molto dal modello tradizione. Secondo i sociologi oggi 4._____ esistono diversi tipi: quella estesa, quella multipla, quella senza struttura coniugale e quella solitaria.
Johanna Viggosdottir – ***Fare famiglia in Italia***", ""));
        // CREATION QUESTION
        $questionnaire_15_1 = $this->createQuestion("TQRU", $questionnaire_15);
        // CREATION SUBQUESTION
        $questionnaire_15_1_1 = $this->createSubquestion("QRU", $questionnaire_15_1, "");
        $questionnaire_15_1_2 = $this->createSubquestion("QRU", $questionnaire_15_1, "");
        $questionnaire_15_1_3 = $this->createSubquestion("QRU", $questionnaire_15_1, "");
        $questionnaire_15_1_4 = $this->createSubquestion("QRU", $questionnaire_15_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_15_1_1_1 = $this->createProposition("1.1. si sviluppa", true, $questionnaire_15_1_1);
        $questionnaire_15_1_1_2 = $this->createProposition("1.2. è sviluppata", false, $questionnaire_15_1_1);
        $questionnaire_15_1_1_3 = $this->createProposition("1.3. ha sviluppato", false, $questionnaire_15_1_1);

        $questionnaire_15_1_2_1 = $this->createProposition("2.1. Da sempre", true, $questionnaire_15_1_2);
        $questionnaire_15_1_2_2 = $this->createProposition("2.2. Quindi", false, $questionnaire_15_1_2);
        $questionnaire_15_1_2_3 = $this->createProposition("2.3. Comunque", false, $questionnaire_15_1_2);

        $questionnaire_15_1_3_1 = $this->createProposition("3.1. si è allontanata", true, $questionnaire_15_1_3);
        $questionnaire_15_1_3_2 = $this->createProposition("3.2. ha allontanato", false, $questionnaire_15_1_3);
        $questionnaire_15_1_3_3 = $this->createProposition("3.3. è allontanato", false, $questionnaire_15_1_3);

        $questionnaire_15_1_4_1 = $this->createProposition("4.1. ne", true, $questionnaire_15_1_4);
        $questionnaire_15_1_4_2 = $this->createProposition("4.2. ci", false, $questionnaire_15_1_4);
        $questionnaire_15_1_4_3 = $this->createProposition("4.3. vi", false, $questionnaire_15_1_4);

        /*******************************************
                    QUESTIONNAIRE 16 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_16 = $this->createQuestionnaire("B1_CE_erasmus", "B1", "CE", $test);
        $questionnaire_16->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_16->setMediaContext($this->mediaText("", "Post su un blog studentesco", ""));
        $questionnaire_16->setMediaText($this->mediaText("L’esperienza Erasmus",
        "Cari amici, @@@al rientro dall’Erasmus, ho avuto la voglia e il bisogno di creare un ***blog*** per condividere questa bellissima esperienza. Perché partire per l’Erasmus? Quelli che 1.___________________ direbbero piuttosto \"Perché non farlo?\" Credo che una delle ragioni 2._______ il desiderio di uscire dalla propria nazione, divertirsi e conoscere giovani provenienti da tutta Europa; senza dimenticarsi  degli esami da sostenere! Penso che una esperienza di questo tipo 3._____________ non solo la possibilità di migliorare o imparare una lingua straniera, ma anche, e soprattutto, 4.________________ di acquisire una maggiore apertura mentale.", ""));
        // CREATION QUESTION
        $questionnaire_16_1 = $this->createQuestion("TQRU", $questionnaire_16);
        // CREATION SUBQUESTION
        $questionnaire_16_1_1 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        $questionnaire_16_1_2 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        $questionnaire_16_1_3 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        $questionnaire_16_1_4 = $this->createSubquestion("QRU", $questionnaire_16_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_16_1_1_1 = $this->createProposition("1.1. lo faranno", false, $questionnaire_16_1_1);
        $questionnaire_16_1_1_2 = $this->createProposition("1.2. l'hanno fatto", true, $questionnaire_16_1_1);
        $questionnaire_16_1_1_3 = $this->createProposition("1.3. lo facevano", false, $questionnaire_16_1_1);

        $questionnaire_16_1_2_1 = $this->createProposition("2.1. sia", true, $questionnaire_16_1_2);
        $questionnaire_16_1_2_2 = $this->createProposition("2.2. è", false, $questionnaire_16_1_2);
        $questionnaire_16_1_2_3 = $this->createProposition("2.3. sarà", false, $questionnaire_16_1_2);

        $questionnaire_16_1_3_1 = $this->createProposition("3.1. offra", true, $questionnaire_16_1_3);
        $questionnaire_16_1_3_2 = $this->createProposition("3.2. offre", false, $questionnaire_16_1_3);
        $questionnaire_16_1_3_3 = $this->createProposition("3.3. abbia offerto", false, $questionnaire_16_1_3);

        $questionnaire_16_1_4_1 = $this->createProposition("4.1. permetta", true, $questionnaire_16_1_4);
        $questionnaire_16_1_4_2 = $this->createProposition("4.2. permette", false, $questionnaire_16_1_4);
        $questionnaire_16_1_4_3 = $this->createProposition("4.3. ha permesso", false, $questionnaire_16_1_4);


        /*******************************************
                    QUESTIONNAIRE 17 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_27 = $this->createQuestionnaire("B1_CE_recette_cuisine", "B1", "CE", $test);
        $questionnaire_27->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_27->setMediaContext($this->mediaText("", "Ricetta su una rivista di cucina", ""));
        $questionnaire_27->setMediaText($this->mediaText("Lasagne ai carciofi",
        "***Ingredienti***:
500 gr di Lasagne
500 gr carciofi
50 gr di burro
500 gr di latte intero
150 gr di farina
100 gr di parmigiano
250 gr di mozzarella
10 cl di vino bianco

***Procedimento***:
Prima di tutto è necessario preparare la besciamella. Mettere in una pentola il burro e quando **1.**_________________ aggiungere la farina e mescolare. Quando **2.**_______________________ un composto omogeneo aggiungete lentamente il latte, che **3.**____________________________ precedentemente.
Aggiungete un pizzico di sale e spegnete il fuoco.
Pulite e tagliate finemente i carciofi e metteteli a cuocere in una padella con un filo d’olio e un po’ di vino bianco. Quando il vino 4.________________________ mettete i carciofi su un piatto e accendete  il forno a 180°.
Imburrate una teglia da forno e disponete la pasta, i carciofi, la besciamella e il formaggio, formando degli strati. Quando il forno sarà caldo e 5.________________________ la teglia, infornatela per 45 minuti.
", ""
));
        // CREATION QUESTION
        $questionnaire_27_1 = $this->createQuestion("TQRU", $questionnaire_27);
        // CREATION SUBQUESTION
        $questionnaire_27_1_1 = $this->createSubquestion("QRU", $questionnaire_27_1, "");
        $questionnaire_27_1_2 = $this->createSubquestion("QRU", $questionnaire_27_1, "");
        $questionnaire_27_1_3 = $this->createSubquestion("QRU", $questionnaire_27_1, "");
        $questionnaire_27_1_4 = $this->createSubquestion("QRU", $questionnaire_27_1, "");
        $questionnaire_27_1_5 = $this->createSubquestion("QRU", $questionnaire_27_1, "");

        // CREATION PROPOSITIONS
        $questionnaire_27_1_1_1 = $this->createProposition("1.1. sarà sciolto", true, $questionnaire_27_1_1);
        $questionnaire_27_1_1_2 = $this->createProposition("1.2. sarebbe sciolto", false, $questionnaire_27_1_1);
        $questionnaire_27_1_1_3 = $this->createProposition("1.3. scioglierà", false, $questionnaire_27_1_1);

        $questionnaire_27_1_2_1 = $this->createProposition("2.1. avrete ottenuto", true, $questionnaire_27_1_2);
        $questionnaire_27_1_2_2 = $this->createProposition("2.2. avrebbe ottenuto", false, $questionnaire_27_1_2);
        $questionnaire_27_1_2_3 = $this->createProposition("2.3. otterrà", false, $questionnaire_27_1_2);

        $questionnaire_27_1_3_1 = $this->createProposition("3.1. 1. avrete scaldato ", true, $questionnaire_27_1_3);
        $questionnaire_27_1_3_2 = $this->createProposition("3.2. avrebbe scaldato", false, $questionnaire_27_1_3);
        $questionnaire_27_1_3_3 = $this->createProposition("3.3. avreste scaldato", false, $questionnaire_27_1_3);

        $questionnaire_27_1_4_1 = $this->createProposition("4.1. sarà evaporato ", true, $questionnaire_27_1_4);
        $questionnaire_27_1_4_2 = $this->createProposition("4.2. sarebbe evaporato", false, $questionnaire_27_1_4);
        $questionnaire_27_1_4_3 = $this->createProposition("4.3. evaporerà", false, $questionnaire_27_1_4);

        $questionnaire_27_1_5_1 = $this->createProposition("5.1. avrete riempito", true, $questionnaire_27_1_5);
        $questionnaire_27_1_5_2 = $this->createProposition("5.2. avrebbe riempito", false, $questionnaire_27_1_5);
        $questionnaire_27_1_5_3 = $this->createProposition("5.3. avreste riempito", false, $questionnaire_27_1_5);


        /*******************************************
                    QUESTIONNAIRE 18 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_18 = $this->createQuestionnaire("B1_CE_critique_restaurant", "B1", "CE", $test);
        $questionnaire_18->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_18->setMediaContext($this->mediaText("", "Recensione di un ristorante su un sito internet", ""));
        $questionnaire_18->setMediaText($this->mediaText("", "Ieri sera ho cenato con la mia ragazza al Ristorante La Lanterna. Il locale è arredato in modo veramente chic, 1.________________ il servizio non è dei migliori.  2.__________________ me lo avessero consigliato non sono rimasto molto soddisfatto: la presentazione dei piatti era poco curata e 3.______________ abbiamo dovuto aspettare mezz’ora prima di mangiare. 4._________________ avevamo mangiato presto a pranzo e nel frattempo siamo morti di fame. 5.___________________, poi abbiamo preso anche il dolce che, devo dire, era davvero ottimo.", ""));
        // CREATION QUESTION
        $questionnaire_18_1 = $this->createQuestion("TQRU", $questionnaire_18);
        // CREATION SUBQUESTION
        $questionnaire_18_1_1 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_2 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_3 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_4 = $this->createSubquestion("QRU", $questionnaire_18_1, "");
        $questionnaire_18_1_5 = $this->createSubquestion("QRU", $questionnaire_18_1, "");

        // CREATION PROPOSITIONS
        $questionnaire_18_1_1_1 = $this->createProposition("1.1. infatti", false, $questionnaire_18_1_1);
        $questionnaire_18_1_1_2 = $this->createProposition("1.2. inoltre", false, $questionnaire_18_1_1);
        $questionnaire_18_1_1_3 = $this->createProposition("1.3. anche se", true, $questionnaire_18_1_1);

        $questionnaire_18_1_2_1 = $this->createProposition("2.1. nonostante", true, $questionnaire_18_1_2);
        $questionnaire_18_1_2_2 = $this->createProposition("2.2. comunque", false, $questionnaire_18_1_2);
        $questionnaire_18_1_2_3 = $this->createProposition("2.3. però", false, $questionnaire_18_1_2);

        $questionnaire_18_1_3_1 = $this->createProposition("3.1. inoltre", true, $questionnaire_18_1_3);
        $questionnaire_18_1_3_2 = $this->createProposition("3.2. dunque", false, $questionnaire_18_1_3);
        $questionnaire_18_1_3_3 = $this->createProposition("3.3. quindi", false, $questionnaire_18_1_3);

        $questionnaire_18_1_4_1 = $this->createProposition("4.1. purtroppo", true, $questionnaire_18_1_4);
        $questionnaire_18_1_4_2 = $this->createProposition("4.2. ma", false, $questionnaire_18_1_4);
        $questionnaire_18_1_4_3 = $this->createProposition("4.3. eppure", false, $questionnaire_18_1_4);

        $questionnaire_18_1_5_1 = $this->createProposition("5.1. infatti", true, $questionnaire_18_1_5);
        $questionnaire_18_1_5_2 = $this->createProposition("5.2. oppure", false, $questionnaire_18_1_5);
        $questionnaire_18_1_5_3 = $this->createProposition("5.3. sebbene", false, $questionnaire_18_1_5);

        /*******************************************
                    QUESTIONNAIRE 21 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_21 = $this->createQuestionnaire("B1_CE_stage_etranger", "B1", "CE", $test);
        $questionnaire_21->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_21->setMediaContext($this->mediaText("", "Articolo su sito internet", ""));
        $questionnaire_21->setMediaText($this->mediaText("Stage all’estero", "Un tirocinio all’estero prevede  un periodo di tempo da trascorrere in un’azienda o in un'istituzione, allo scopo di iniziare la propria formazione professionale. È un rapporto flessibile, regolato da leggi ministeriali, la cui durata varia per tipologia. Un tirocinio all'estero è un'occasione per chi vuole cominciare a muoversi in un contesto internazionale e aprirsi a nuove prospettive. Una volta terminato, l’esperienza sarà certificata da un attestato che acquisterà valore di credito formativo e che potrai annotare sul tuo curriculum.", ""));
        // CREATION QUESTION
        $questionnaire_21_1 = $this->createQuestion("TVF", $questionnaire_21);
        // CREATION SUBQUESTION
        //$questionnaire_21_1_1 = $this->createSubquestion("QRM", $questionnaire_21_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_21_1_1_1 = $this->createProposition("Il tirocinio all’estero è un’opportunità per cominciare la propria esperienza lavorativa in un contesto internazionale", true, $questionnaire_21_1_1);
        //$questionnaire_21_1_1_2 = $this->createProposition("I tirocini all’estero hanno sempre la stessa durata, in ogni settore lavorativo ", false, $questionnaire_21_1_1);
        //$questionnaire_21_1_1_3 = $this->createProposition("Il tirocinio all’estero consente di accumulare crediti universitari per il piano di studio", false, $questionnaire_21_1_1);

        // CREATION SUBQUESTION
        $questionnaire_21_1_1 = $this->createSubquestionVF("VF", $questionnaire_21_1, "", "Il tirocinio all’estero è un’opportunità per cominciare la propria esperienza lavorativa in un contesto internazionale");
        $questionnaire_21_1_2 = $this->createSubquestionVF("VF", $questionnaire_21_1, "", "I tirocini all’estero hanno sempre la stessa durata, in ogni settore lavorativo");
        $questionnaire_21_1_3 = $this->createSubquestionVF("VF", $questionnaire_21_1, "", "Il tirocinio all’estero consente di accumulare crediti universitari per il piano di studio");

        // CREATION PROPOSITIONS
        $questionnaire_21_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_21_1_1);
        $questionnaire_21_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_21_1_1);

        $questionnaire_21_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_21_1_2);
        $questionnaire_21_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_21_1_2);

        $questionnaire_21_1_1_3 = $this->createPropositionVF("", "VRAI", false, $questionnaire_21_1_3);
        $questionnaire_21_1_1_3 = $this->createPropositionVF("", "FAUX", true, $questionnaire_21_1_3);



        /*******************************************
                    QUESTIONNAIRE 22 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_22 = $this->createQuestionnaire("B1_CE_sauvegarde_forets", "B1", "CE", $test);
        $questionnaire_22->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_22->setMediaContext($this->mediaText("", "Articolo su sito internet", ""));
        $questionnaire_22->setMediaText($this->mediaText("Come possiamo salvare le foreste pluviali?", "Le foreste amazzoniche stanno scomparendo molto velocemente a causa della grande produzione di olio di palma. La buona notizia però è che sempre più persone sono sensibilizzate alla salvaguardia delle foreste. La brutta notizia invece sta nel fatto che difendere le foreste non è poi così facile. Bisognerebbe avere l'aiuto e la cooperazione di molti per poter difendere le foreste e la vita animale affinché i nostri figli possano goderne un giorno.", ""));
        // CREATION QUESTION
        $questionnaire_22_1 = $this->createQuestion("TQRU", $questionnaire_22);
        // CREATION SUBQUESTION
        $questionnaire_22_1_1 = $this->createSubquestion("QRU", $questionnaire_22_1, "");
        $questionnaire_22_1_2 = $this->createSubquestion("QRU", $questionnaire_22_1, "");
        $questionnaire_22_1_3 = $this->createSubquestion("QRU", $questionnaire_22_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_22_1_1_1 = $this->createProposition("1.1. Però", true, $questionnaire_22_1_1);
        $questionnaire_22_1_1_2 = $this->createProposition("1.2. nonostante", false, $questionnaire_22_1_1);
        $questionnaire_22_1_1_3 = $this->createProposition("1.3. quindi", false, $questionnaire_22_1_1);

        $questionnaire_22_1_2_1 = $this->createProposition("2.1. invece", true, $questionnaire_22_1_2);
        $questionnaire_22_1_2_2 = $this->createProposition("2.2. nemmeno ", false, $questionnaire_22_1_2);
        $questionnaire_22_1_2_3 = $this->createProposition("2.3. anche", false, $questionnaire_22_1_2);

        $questionnaire_22_1_3_1 = $this->createProposition("3.1. affiché", true, $questionnaire_22_1_3);
        $questionnaire_22_1_3_2 = $this->createProposition("3.2. dunque", false, $questionnaire_22_1_3);
        $questionnaire_22_1_3_3 = $this->createProposition("3.3. perciò", false, $questionnaire_22_1_3);

        /*******************************************
                    QUESTIONNAIRE 23 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_23 = $this->createQuestionnaire("B1_CE_unicef", "B1", "CE", $test);
        $questionnaire_23->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_23->setMediaContext($this->mediaText("", "Articolo su internet", ""));
        $questionnaire_23->setMediaText($this->mediaText("Diventa Volontario. Dai anche tu un prezioso contributo per salvare la vita di un bambino.",
"Le principali attività dei volontari sono orientate alla promozione dei diritti dell'infanzia in Italia e alla realizzazione a livello territoriale delle campagne UNICEF a sostegno dei programmi nei Paesi in via di sviluppo.@@@
Contattando il Comitato UNICEF della tua città (ce ne sono 110, uno per ogni Provincia italiana) puoi impegnarti nei nostri \"eventi di piazza\" nazionali e in tutte le altre iniziative locali di raccolta fondi e di sensibilizzazione sui diritti dell'infanzia.@@@
Se hai tra 14 e 30 anni, puoi entrare a far parte di ***Younicef***, il movimento di volontariato giovanile dell'UNICEF Italia, attivo in ogni parte del Paese.
", ""));
        // CREATION QUESTION
        $questionnaire_23_1 = $this->createQuestion("TVF", $questionnaire_23);
        // CREATION SUBQUESTION
        //$questionnaire_23_1_1 = $this->createSubquestion("QRM", $questionnaire_23_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_23_1_1_1 = $this->createProposition("Il volontario Unicef svolge la sua azione unicamente nei paesi in via di sviluppo", false, $questionnaire_23_1_1);
        //$questionnaire_23_1_1_2 = $this->createProposition("I volontari Unicef sono impiegati nella raccolta di denaro per finanziare i progetti", true, $questionnaire_23_1_1);
        //$questionnaire_23_1_1_3 = $this->createProposition("***Younicef*** accoglie tra i suoi volontari persone di tutte le età", false, $questionnaire_23_1_1);

        // CREATION SUBQUESTION
        $questionnaire_23_1_1 = $this->createSubquestionVF("VF", $questionnaire_23_1, "", "Il volontario Unicef svolge la sua azione unicamente nei paesi in via di sviluppo");
        $questionnaire_23_1_2 = $this->createSubquestionVF("VF", $questionnaire_23_1, "", "I volontari Unicef sono impiegati nella raccolta di denaro per finanziare i progetti");
        $questionnaire_23_1_3 = $this->createSubquestionVF("VF", $questionnaire_23_1, "", "***Younicef*** accoglie tra i suoi volontari persone di tutte le età");

        // CREATION PROPOSITIONS
        $questionnaire_23_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_23_1_1);
        $questionnaire_23_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_23_1_1);

        $questionnaire_23_1_1_2 = $this->createPropositionVF("", "VRAI", true, $questionnaire_23_1_2);
        $questionnaire_23_1_1_2 = $this->createPropositionVF("", "FAUX", false, $questionnaire_23_1_2);

        $questionnaire_23_1_1_3 = $this->createPropositionVF("", "VRAI", false, $questionnaire_23_1_3);
        $questionnaire_23_1_1_3 = $this->createPropositionVF("", "FAUX", true, $questionnaire_23_1_3);

        /*******************************************
                    QUESTIONNAIRE 24 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_24 = $this->createQuestionnaire("B1_CE_lecture", "B1", "CE", $test);
        $questionnaire_24->setMediaInstruction($this->mediaText("", "Seleziona il riassunto corretto", ""));
        $questionnaire_24->setMediaContext($this->mediaText("", "Articolo su internet", ""));
        $questionnaire_24->setMediaText($this->mediaText("L’importanza della lettura : partiamo dai classici.",
        "Leggere significa appropriarsi delle esperienze di migliaia di personaggi immaginari e farne tesoro; le esperienze acquisite saranno utili per affrontare le disavventure della vita. Le mille asperità che ogni adolescente si trova a sostenere sono le stesse che i protagonisti dei grandi romanzi di formazione si trovano a fronteggiare L'amore perduto, l'odio, la vendetta, la rabbia e il senso d'impotenza possono indebolire un giovane ancora fragile, per questo avere interiorizzato decine, centinaia di esperienze simili, certo di personaggi immaginari, può essere utile e può fare la differenza.", ""));

        // CREATION QUESTION
        $questionnaire_24_1 = $this->createQuestion("TQRU", $questionnaire_24);
        // CREATION SUBQUESTION
        $questionnaire_24_1_1 = $this->createSubquestion("QRU", $questionnaire_24_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_24_1_1_1 = $this->createProposition("Leggere i grandi romanzi aiuta i giovani a non sentirsi soli nelle disavventure della vita, poiché i problemi affrontati dai protagonisti della letteratura sono simili a quelli degli adolescenti del giorno d’oggi.", true, $questionnaire_24_1_1);
        $questionnaire_24_1_1_2 = $this->createProposition("I romanzi di formazione raccontano tutte le tappe della vita, per questo, leggerli può aiutare i personaggi immaginari a affrontare i momento più complessi della vita.", false, $questionnaire_24_1_1);
        $questionnaire_24_1_1_3 = $this->createProposition("I romanzi di formazione raccontando l’amore, l’odio, la rabbia ed altri sentimenti, indeboliscono l’animo degli adolescenti che purtroppo è già fragile.", false, $questionnaire_24_1_1);

        /*******************************************
                    QUESTIONNAIRE 25 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_25 = $this->createQuestionnaire("B1_CE_mail_travail", "B1", "CE", $test);
        $questionnaire_25->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_25->setMediaContext($this->mediaText("", "Mail di lavoro", ""));
        $questionnaire_25->setMediaText($this->mediaText("", "Gentile Direttore,
Le scrivo in merito alla riunione che si è svolta questa mattina con i colleghi dell’ufficio di Boston. Il manager del gruppo è molto ottimista sul progetto, 1.________ a mio parere non ha valutato tutte le conseguenze. Non abbiamo avuto tempo per discutere i dettagli ma, 2.___________, la sua strategia è chiara. Vorrebbe spingerci a promuovere il prodotto adesso sul mercato americano. Dobbiamo  3.______________ tenere presente che questa decisione comporta dei rischi : se 4. ____________ la sua proposta è interessante date le possibilità di guadagno elevate, 5. ________ mi sembra che a livello di costi sia finanziariamente inaccettabile.@@@
Tutti i dettagli della riunione sono presenti in allegato.@@@
Buona giornata@@@
Dott.ssa Angela Pitti
", ""));
        // CREATION QUESTION
        $questionnaire_25_1 = $this->createQuestion("TQRU", $questionnaire_25);
        // CREATION SUBQUESTION
        $questionnaire_25_1_1 = $this->createSubquestion("QRU", $questionnaire_25_1, "");
        $questionnaire_25_1_2 = $this->createSubquestion("QRU", $questionnaire_25_1, "");
        $questionnaire_25_1_3 = $this->createSubquestion("QRU", $questionnaire_25_1, "");
        $questionnaire_25_1_4 = $this->createSubquestion("QRU", $questionnaire_25_1, "");
        $questionnaire_25_1_5 = $this->createSubquestion("QRU", $questionnaire_25_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_25_1_1_1 = $this->createProposition("1.1. però", true, $questionnaire_25_1_1);
        $questionnaire_25_1_1_2 = $this->createProposition("1.2. infatti", false, $questionnaire_25_1_1);
        $questionnaire_25_1_1_3 = $this->createProposition("1.3. inoltre", false, $questionnaire_25_1_1);

        $questionnaire_25_1_2_1 = $this->createProposition("2.1. ma", true, $questionnaire_25_1_2);
        $questionnaire_25_1_2_2 = $this->createProposition("2.2. di conseguenza", false, $questionnaire_25_1_2);
        $questionnaire_25_1_2_3 = $this->createProposition("2.3. in particolare", false, $questionnaire_25_1_2);

        $questionnaire_25_1_3_1 = $this->createProposition("3.1. tuttavia", true, $questionnaire_25_1_3);
        $questionnaire_25_1_3_2 = $this->createProposition("3.2. sebbene", false, $questionnaire_25_1_3);
        $questionnaire_25_1_3_3 = $this->createProposition("3.3. come", false, $questionnaire_25_1_3);

        $questionnaire_25_1_4_1 = $this->createProposition("4.1. da un lato", true, $questionnaire_25_1_4);
        $questionnaire_25_1_4_2 = $this->createProposition("4.2. anzi", false, $questionnaire_25_1_4);
        $questionnaire_25_1_4_3 = $this->createProposition("4.3. qualora", false, $questionnaire_25_1_4);

        $questionnaire_25_1_5_1 = $this->createProposition("5.1. dall'altro", true, $questionnaire_25_1_5);
        $questionnaire_25_1_5_2 = $this->createProposition("5.2. perché", false, $questionnaire_25_1_5);
        $questionnaire_25_1_3_3 = $this->createProposition("5.3. quindi", false, $questionnaire_25_1_5);

        /*******************************************
                    QUESTIONNAIRE 26 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_26 = $this->createQuestionnaire("B1_CE_lettre_reclamation", "B1", "CE", $test);
        $questionnaire_26->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_26->setMediaContext($this->mediaText("", "Mail di reclamo", ""));
        $questionnaire_26->setMediaText($this->mediaText("",
        "Gentile Responsabile del Servizio Clienti,@@@Le scrivo 1. ______________  all’offerta vacanze  \"Sole, mare e relax a Cefalonia\" della durata di una settimana che ho acquistato sul vostro sito internet.
Non sono per niente soddisfatto del vostro servizio. Sul sito internet l’hotel era descritto come un’oasi di pace, ma 2. ____________ era situato vicino ad una discoteca.
3. _______________, nel pacchetto si parlava di un ristorante di pesce molto famoso, che a dire il V era di bassa qualità.
Trovo scandaloso che un’azienda come la vostra non solo venda dei servizi che poi non offre, ma che prenda in giro i suoi clienti.4. _______________ sconsiglierò la vostra agenzia a tutte le persone che conosco.@@@
Cordiali saluti,@@@Gianni Rossi
", ""));
        // CREATION QUESTION
        $questionnaire_26_1 = $this->createQuestion("TQRU", $questionnaire_26);
        // CREATION SUBQUESTION
        $questionnaire_26_1_1 = $this->createSubquestion("QRU", $questionnaire_26_1, "");
        $questionnaire_26_1_2 = $this->createSubquestion("QRU", $questionnaire_26_1, "");
        $questionnaire_26_1_3 = $this->createSubquestion("QRU", $questionnaire_26_1, "");
        $questionnaire_26_1_4 = $this->createSubquestion("QRU", $questionnaire_26_1, "");

        // CREATION PROPOSITIONS
        $questionnaire_26_1_1_1 = $this->createProposition("1.1. in merito", true, $questionnaire_26_1_1);
        $questionnaire_26_1_1_2 = $this->createProposition("1.2. a proposito", false, $questionnaire_26_1_1);
        $questionnaire_26_1_1_3 = $this->createProposition("1.3. circa", false, $questionnaire_26_1_1);

        $questionnaire_26_1_2_1 = $this->createProposition("2.1. in realtà", true, $questionnaire_26_1_2);
        $questionnaire_26_1_2_2 = $this->createProposition("2.2. dunque", false, $questionnaire_26_1_2);
        $questionnaire_26_1_2_3 = $this->createProposition("2.3. comunque", false, $questionnaire_26_1_2);

        $questionnaire_26_1_3_1 = $this->createProposition("3.1. inoltre", true, $questionnaire_26_1_3);
        $questionnaire_26_1_3_2 = $this->createProposition("3.2. al contrario", false, $questionnaire_26_1_3);
        $questionnaire_26_1_3_3 = $this->createProposition("3.3. poiché", false, $questionnaire_26_1_3);

        $questionnaire_26_1_4_1 = $this->createProposition("4.1. per questo", true, $questionnaire_26_1_4);
        $questionnaire_26_1_4_2 = $this->createProposition("4.2. in realtà", false, $questionnaire_26_1_4);
        $questionnaire_26_1_4_3 = $this->createProposition("4.3. in alternativa", false, $questionnaire_26_1_4);


        /*******************************************
                    QUESTIONNAIRE 27 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_27 = $this->createQuestionnaire("B1_CE_diner_ciel", "B1", "CE", $test);
        $questionnaire_27->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false", ""));
        $questionnaire_27->setMediaContext($this->mediaText("", "Articolo da blog", ""));
        $questionnaire_27->setMediaText($this->mediaText("***Cene in Cielo***", "Talvolta a rendere speciale la cena non sono né gli ingredienti né l’abilità del cuoco, ma l’insolito panorama di cui potrete godere mentre cenate  sospesi a 50 metri d’altezza.
Se siete tra coloro che non temono l’avventura ma anzi più di qualsiasi cosa detestano la solita routine quotidiana e soprattutto non soffrite di vertigini, potreste cenare nel vuoto a circa 50 metri d’altezza, sullo sfondo di splendidi panorami.@@@
Ad offrire questo insolito servizio è ***Cene In Cielo***, società specializzata nell’organizzazione di cene, aperitivi e feste a bordo di una piattaforma che, insieme a chef, camerieri ed ospiti, viene sollevata ad altezze adrenaliniche. Sia chiaro, la cena è ad alto tasso di divertimento ma a rischio zero: gli ospiti cenano attaccati alle proprie sedie protetti dalle cinture di sicurezza e anche il personale, assicurato a delle corde, lavora in tutta tranquillità.
", ""));
        // CREATION QUESTION
        $questionnaire_27_1 = $this->createQuestion("TVF", $questionnaire_27);
        // CREATION SUBQUESTION
        //$questionnaire_17_1_1 = $this->createSubquestion("QRM", $questionnaire_17_1, "");
        // CREATION PROPOSITIONS
        //$questionnaire_17_1_1_1 = $this->createProposition("***Cene in cielo*** propone delle serate speciali in ristoranti dove cuochi di alto livello promuovono ingredienti di alta qualità", false, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_2 = $this->createProposition("Il servizio proposto è adatto anche alle persone che soffrono di vertigini", false, $questionnaire_17_1_1);
        //$questionnaire_17_1_1_3 = $this->createProposition("Gli eventi proposti avvengono sempre nel massimo della sicurezza per il cliente e per i dipendenti dell’organizzazione", true, $questionnaire_17_1_1);

        // CREATION SUBQUESTION
        $questionnaire_27_1_1 = $this->createSubquestionVF("VF", $questionnaire_27_1, "", "***Cene in cielo*** propone delle serate speciali in ristoranti dove cuochi di alto livello promuovono ingredienti di alta qualità");
        $questionnaire_27_1_2 = $this->createSubquestionVF("VF", $questionnaire_27_1, "", "Il servizio proposto è adatto anche alle persone che soffrono di vertigini");
        $questionnaire_27_1_3 = $this->createSubquestionVF("VF", $questionnaire_27_1, "", "Gli eventi proposti avvengono sempre nel massimo della sicurezza per il cliente e per i dipendenti dell’organizzazione");

        // CREATION PROPOSITIONS
        $questionnaire_27_1_1_1 = $this->createPropositionVF("", "VRAI", false, $questionnaire_27_1_1);
        $questionnaire_27_1_1_1 = $this->createPropositionVF("", "FAUX", true, $questionnaire_27_1_1);

        $questionnaire_27_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_27_1_2);
        $questionnaire_27_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_27_1_2);

        $questionnaire_27_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_27_1_3);
        $questionnaire_27_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_27_1_3);



        /*******************************************
                    QUESTIONNAIRE 28 : QRM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_28 = $this->createQuestionnaire("B1_CE_reglement_gym", "B1", "CE", $test);
        $questionnaire_28->setMediaInstruction($this->mediaText("", "Tre informazioni sono presenti nel testo. Quali?", ""));
        $questionnaire_28->setMediaContext($this->mediaText("", "Regolamento", ""));
        $questionnaire_28->setMediaText($this->mediaText("Regolamento palestra Body Club", "Nella frequentazione della palestra Body club è vietato:@@@
- lasciare durante o alla fine dell’allenamento, bottiglie varie e  rifiuti nei locali della palestra;@@@
- accedere ai locali della palestra con scarpe indossate all’esterno;@@@
- fumare all’interno dei locali della palestra, negli spogliatoi e nei servizi igienici;@@@
- introdurre e consumare bevande alcoliche all’interno della palestra, negli spogliatoi e nei servizi igienici;@@@
- far uso di sostanze ritenute dopanti ai sensi delle norme riconosciute in Italia e introdurle in palestra;@@@
- lasciare uscire i bambini dallo spazio a loro dedicato e circolare nella palestra;@@@
- disturbare ed intralciare nell’allenamento gli altri utenti con il proprio comportamento;@@@
- introdurre ogni tipo di animale nei locali della palestra, negli spogliatoi e nei servizi igienici;@@@
- l’ingresso in palestra senza aver obliterato la tessera personale.@@@
", ""));
        // CREATION QUESTION
        $questionnaire_28_1 = $this->createQuestion("QRM", $questionnaire_28);
        // CREATION SUBQUESTION
        $questionnaire_28_1_1 = $this->createSubquestion("QRM", $questionnaire_28_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_28_1_1_1 = $this->createProposition("All’interno della palestra non è permesso mangiare", false, $questionnaire_28_1_1);
        $questionnaire_28_1_1_2 = $this->createProposition("L’ingresso agli animali è vietato nei locali della palestra", true, $questionnaire_28_1_1);
        $questionnaire_28_1_1_3 = $this->createProposition("Per accedere ai locali della palestra è obbligatorio  timbrare la tessera", true, $questionnaire_28_1_1);
        $questionnaire_28_1_1_4 = $this->createProposition("L’accesso ai locali della palestra è consentito solo con scarpe con suola di gomma", false, $questionnaire_28_1_1);
        $questionnaire_28_1_1_5 = $this->createProposition("I bambini possono utilizzare la palestra ma solo negli spazi previsti", true, $questionnaire_28_1_1);



        /* Reste B2 à vérifier. ERV. 04/03/2014.*/

        /*******************************************

                    NIVEAU : B2

        ********************************************/


        /*******************************************
                    QUESTIONNAIRE 1 : TVFNM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_1 = $this->createQuestionnaire("B2_CE_COMM_Come diventare famosi su internet", "B2", "CE", $test);
        $questionnaire_B2_1->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere, false o non dette.", ""));
        $questionnaire_B2_1->setMediaContext($this->mediaText("", "Post su blog", ""));
        $questionnaire_B2_1->setMediaText($this->mediaText("Come diventare famosi su internet", "La celeberrima frase “Nel futuro, tutti avranno 15 minuti di celebrità”, pronunciata nel 1968 da Andy Warhol, diventa ogni giorno più profetica su internet. Ecco qualche consiglio su come diventare una web celebrity.@@@
• Occhio a chi incontri su internet ed evita di condividere troppe informazioni personali.@@@
• Gira un video su di te o sul tuo talento e pubblicalo su YouTube.@@@
• Il successo va e viene. Però, se lavori duro, offri contenuti freschi ed incanti i tuoi lettori, follower e spettatori, sarà più facile mantenerti a galla. Punta ad una fama che ti permetta di avere un articolo dedicato a te su Wikipedia e che ti consenta di poter dire che hai raggiunto una certa notorietà. In questo modo, il tuo successo si terrà in piedi, a meno che qualcuno non ti cancelli ma, ehi, siamo su internet!
", ""));
        // CREATION QUESTION
        $questionnaire_B2_1_1 = $this->createQuestion("TVFNM", $questionnaire_B2_1);
        // CREATION SUBQUESTION
        $questionnaire_B2_1_1_1 = $this->createSubquestion("VFNM", $questionnaire_B2_1_1, "1. La celebre frase di Andy Warhol è stata letta da milioni di utenti su internet.");
        $questionnaire_B2_1_1_2 = $this->createSubquestion("VFNM", $questionnaire_B2_1_1, "2. Secondo l’autore il successo su internet è un fenomeno duraturo.");
        $questionnaire_B2_1_1_3 = $this->createSubquestion("VFNM", $questionnaire_B2_1_1, "3. Il testo consiglia di pubblicare sempre articoli attuali per conservare il successo ottenuto");
        // CREATION PROPOSITIONS
        $questionnaire_B2_1_1_1_1 = $this->createProposition("VRAI", false, $questionnaire_B2_1_1_1);
        $questionnaire_B2_1_1_1_2 = $this->createProposition("FAUX", false, $questionnaire_B2_1_1_1);
        $questionnaire_B2_1_1_1_3 = $this->createProposition("ND", true, $questionnaire_B2_1_1_1);

        $questionnaire_B2_1_1_2_1 = $this->createProposition("VRAI", false, $questionnaire_B2_1_1_2);
        $questionnaire_B2_1_1_2_2 = $this->createProposition("FAUX", true, $questionnaire_B2_1_1_2);
        $questionnaire_B2_1_1_2_3 = $this->createProposition("ND", false, $questionnaire_B2_1_1_2);

        $questionnaire_B2_1_1_3_1 = $this->createProposition("VRAI", true, $questionnaire_B2_1_1_3);
        $questionnaire_B2_1_1_3_2 = $this->createProposition("FAUX", false, $questionnaire_B2_1_1_3);
        $questionnaire_B2_1_1_3_3 = $this->createProposition("ND", false, $questionnaire_B2_1_1_3);

        /*******************************************
                    QUESTIONNAIRE 4 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_4 = $this->createQuestionnaire("B2_CE_COMM_come affrontare gli esami", "B2", "CE", $test);
        $questionnaire_B2_4->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta.", ""));
        $questionnaire_B2_4->setMediaContext($this->mediaText("", "Post su blog studentesco", ""));
        $questionnaire_B2_4->setMediaText($this->mediaText("Breve decalogo per gli studenti: prima di affrontare un esame",
        "• Il \"nemico\" va conosciuto. Andate ad assistere agli esami prima di darli.@@@
• Siate gradevoli nell'aspetto. L'abito in questo caso fa il monaco.@@@
• Sappiate ascoltare. Aspettate a rispondere finché il docente non ha concluso la domanda.@@@
• Siate precisi, non arrampicatevi sugli specchi. Se non sapete la risposta non dite cose inesatte.@@@
• Se avete un vuoto mentale, ammettetelo. Chiedete poi al professore di riproporvi successivamente la domanda.", ""));
        // CREATION QUESTION
        $questionnaire_B2_4_1 = $this->createQuestion("TQRU", $questionnaire_B2_4);
        // CREATION SUBQUESTION
        $questionnaire_B2_4_1_1 = $this->createSubquestion("QRU", $questionnaire_B2_4_1, "**1. Il decalogo suggerisce di:**");
        $questionnaire_B2_4_1_2 = $this->createSubquestion("QRU", $questionnaire_B2_4_1, "**2. Se non si conosce la risposta, il decalogo suggerisce di:**");

        // CREATION PROPOSITIONS
        $questionnaire_B2_4_1_1_1 = $this->createProposition("1.1. studiare le domande più frequenti poste durante gli esami.", false, $questionnaire_B2_4_1_1);
        $questionnaire_B2_4_1_1_2 = $this->createProposition("1.2. osservare gli esami sostenuti da altri studenti.", true, $questionnaire_B2_4_1_1);
        $questionnaire_B2_4_1_1_3 = $this->createProposition("1.3. anticipare le risposte per fare una buona impressione", false, $questionnaire_B2_4_1_1);
        $questionnaire_B2_4_1_1_4 = $this->createProposition("1.4.  assistere agli esami dei colleghi per poter scegliere il giusto abbigliamento.", false, $questionnaire_B2_4_1_1);

        $questionnaire_B2_4_1_2_1 = $this->createProposition("2.1. dare comunque una risposta vaga ma il più possibile verosimile.", false, $questionnaire_B2_4_1_2);
        $questionnaire_B2_4_1_2_2 = $this->createProposition("2.2. ragionare sulle domande ed arrivare ad una soluzione logica.", false, $questionnaire_B2_4_1_2);
        $questionnaire_B2_4_1_2_3 = $this->createProposition("2.3. rinunciare a rispondere subito per evitare un’espressione vaga e incompleta.", true, $questionnaire_B2_4_1_2);
        $questionnaire_B2_4_1_2_4 = $this->createProposition("2.4. evitare di tacere cercando però di non dare risposte totalmente inesatte.", false, $questionnaire_B2_4_1_2);


        /*******************************************
                    QUESTIONNAIRE 6 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_6 = $this->createQuestionnaire("B2_CE_COMM_disdetta_contratto", "B1", "CE", $test);
        $questionnaire_B2_6->setMediaInstruction($this->mediaText("", "Seleziona il riassunto corretto", ""));
        $questionnaire_B2_6->setMediaContext($this->mediaText("", "Lettera di disdetta contratto di locazione", ""));
        $questionnaire_B2_6->setMediaText($this->mediaText("Disdetta straordinaria del contratto di locazione",
        "Sig. Giacomo Verni@@@
via Rodolfo Lanciani, 3@@@
00100 Roma@@@

Raccomandata@@@

Roma, 12.10:2012@@@

Disdetta straordinaria del contratto di locazione@@@

Gentile sig. Pastani,
con la presente le comunico la mia intenzione di recedere dal contratto di locazione stipulato in data 09/10/2010 fuori dai termini stabiliti per il 30/10/2012. Dato che per motivi lavorativi devo traslocare non mi è possibile dare la disdetta nei termini fissati.@@@
Mi preoccuperò di cercare un inquilino subentrante adeguato e di inviarle i relativi documenti per la candidatura.@@@
La prego di informarmi al più presto sul termine di consegna dell’appartamento.@@@

Colgo l’occasione per ringraziarla del piacevole rapporto di locazione.@@@

Cordiali saluti@@@

Giacomo Verni@@@

____________________  ______________________
Luogo, data                           Firma del locatore
", ""));

        // CREATION QUESTION
        $questionnaire_B2_6_1 = $this->createQuestion("QRU", $questionnaire_B2_6);
        // CREATION SUBQUESTION
        $questionnaire_B2_6_1_1 = $this->createSubquestion("QRU", $questionnaire_B2_6_1, "");
        // CREATION PROPOSITIONS
        $questionnaire_B2_6_1_1_1 = $this->createProposition("1. Il Sig. Verni scrive al Sig. Pastani per chiedere la sospensione temporanea del contratto di affitto. Si impegna comunque a trovare un sostituto per i mesi in cui sarà assente.", false, $questionnaire_B2_6_1_1);
        $questionnaire_B2_6_1_1_2 = $this->createProposition("2. Il Sig Verni scrive al sig.Pastani per rescindere il contratto d’affitto con ampio anticipo, e si impegna con il proprietario a inviargli il nome del futuro inquilino.", false, $questionnaire_B2_6_1_1);
        $questionnaire_B2_6_1_1_3 = $this->createProposition("3. Il Sig Verni scrive al sig.Pastani per richiedere la sospensione anticipata del contratto. Chiede inoltre di essere informato sulla data esatta in cui dovrà lasciare l’appartamento.", true, $questionnaire_B2_6_1_1);


        /*******************************************
                    QUESTIONNAIRE 7 : TVF
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_7 = $this->createQuestionnaire("B1_CE_diner_ciel", "B1", "CE", $test);
        $questionnaire_B2_7->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere o false.", ""));
        $questionnaire_B2_7->setMediaContext($this->mediaText("", "Avviso in Comune", ""));
        $questionnaire_B2_7->setMediaText($this->mediaText("Informazioni utili sulla tessera elettorale", "Tessera elettorale per le elezioni politiche

L’ufficio elettorale comunale resta a  disposizione per quanto segue:@@@

• coloro che non avessero ricevuto la tessera elettorale a domicilio, possono ritirarla presso l’ufficio elettorale-;@@@
• coloro che avessero smarrito, deteriorato o subito il furto della tessera elettorale, possono ottenere un duplicato presentandosi all’ufficio elettorale.@@@
• Nel caso di smarrimento la domanda di duplicato deve essere corredata da denuncia presentata ai competenti uffici di pubblica sicurezza.@@@
", ""));
        // CREATION QUESTION
        $questionnaire_B2_7_1 = $this->createQuestion("TVF", $questionnaire_B2_7);

        // CREATION SUBQUESTION
        $questionnaire_B2_7_1_1 = $this->createSubquestionVF("VF", $questionnaire_B2_7_1, "", "1. Nel caso in cui la tessera non fosse arrivata per posta, bisogna recarsi all’ufficio elettorale");
        $questionnaire_B2_7_1_2 = $this->createSubquestionVF("VF", $questionnaire_B2_7_1, "", "2. Coloro, la cui tessera elettorale fosse rovinata, possono chiedere di riceverne una copia a casa.");
        $questionnaire_B2_7_1_3 = $this->createSubquestionVF("VF", $questionnaire_B2_7_1, "", "3. Coloro che avessero perso la tessera elettorale, devono avvertire la polizia della perdita");

        // CREATION PROPOSITIONS
        $questionnaire_B2_7_1_1_1 = $this->createPropositionVF("", "VRAI", true, $questionnaire_B2_7_1_1);
        $questionnaire_B2_7_1_1_1 = $this->createPropositionVF("", "FAUX", false, $questionnaire_B2_7_1_1);

        $questionnaire_B2_7_1_1_2 = $this->createPropositionVF("", "VRAI", false, $questionnaire_B2_7_1_2);
        $questionnaire_B2_7_1_1_2 = $this->createPropositionVF("", "FAUX", true, $questionnaire_B2_7_1_2);

        $questionnaire_B2_7_1_1_3 = $this->createPropositionVF("", "VRAI", true, $questionnaire_B2_7_1_3);
        $questionnaire_B2_7_1_1_3 = $this->createPropositionVF("", "FAUX", false, $questionnaire_B2_7_1_3);


        /*******************************************
                    QUESTIONNAIRE 9 : TVFNM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_9 = $this->createQuestionnaire("B2_CE_COMM_occhi su saturno", "B2", "CE", $test);
        $questionnaire_B2_9->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere, false o non dette.", ""));
        $questionnaire_B2_9->setMediaContext($this->mediaText("", "Articolo su rivista di eventi culturali", ""));
        $questionnaire_B2_9->setMediaText($this->mediaText("Occhi su Saturno", "Sabato18 Maggio,una sera per mostrare Saturno all’Italia@@@
La sera del 18 Maggio cerca l'evento a te più vicino e scopri dal vivo Saturno, senza dubbio il più bel pianeta del Sistema Solare, generazioni di astronomi hanno posato gli occhi su di lui. Ora grazie alle sonde spaziali abbiamo una visione senza precedenti di Saturno, dei suoi anelli e dei suoi satelliti. Ma lo splendore di questo pianeta è folgorante anche se osservato con un piccolo telescopio.",
 ""));
        // CREATION QUESTION
        $questionnaire_B2_9_1 = $this->createQuestion("TVFNM", $questionnaire_B2_9);
        // CREATION SUBQUESTION
        $questionnaire_B2_9_1_1 = $this->createSubquestion("VFNM", $questionnaire_B2_9_1, "1. “Occhi su Saturno” è un’iniziativa organizzata da un gruppo di astronomi");
        $questionnaire_B2_9_1_2 = $this->createSubquestion("VFNM", $questionnaire_B2_9_1, "2. L’iniziativa non sarà solo locale, ma avrà luogo anche in diverse regioni italiane.");
        $questionnaire_B2_9_1_3 = $this->createSubquestion("VFNM", $questionnaire_B2_9_1, "3. Il pianeta sarà visibile ad occhio nudo.");
        // CREATION PROPOSITIONS
        $questionnaire_B2_9_1_1_1 = $this->createProposition("VRAI", false, $questionnaire_B2_9_1_1);
        $questionnaire_B2_9_1_1_2 = $this->createProposition("FAUX", false, $questionnaire_B2_9_1_1);
        $questionnaire_B2_9_1_1_3 = $this->createProposition("ND", true, $questionnaire_B2_9_1_1);

        $questionnaire_B2_9_1_2_1 = $this->createProposition("VRAI", true, $questionnaire_B2_9_1_2);
        $questionnaire_B2_9_1_2_2 = $this->createProposition("FAUX", false, $questionnaire_B2_9_1_2);
        $questionnaire_B2_9_1_2_3 = $this->createProposition("ND", false, $questionnaire_B2_9_1_2);

        $questionnaire_B2_9_1_3_1 = $this->createProposition("VRAI", false, $questionnaire_B2_9_1_3);
        $questionnaire_B2_9_1_3_2 = $this->createProposition("FAUX", true, $questionnaire_B2_9_1_3);
        $questionnaire_B2_9_1_3_3 = $this->createProposition("ND", false, $questionnaire_B2_9_1_3);

        /*******************************************
                    QUESTIONNAIRE 10 : TVFNM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_10 = $this->createQuestionnaire("B2_CE_COMM_candidatura", "B2", "CE", $test);
        $questionnaire_B2_10->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere, false o non dette.", ""));
        $questionnaire_B2_10->setMediaContext($this->mediaText("", "Lettera di motivazione", ""));
        $questionnaire_B2_10->setMediaText($this->mediaText("Candidatura spontanea", "vorrei sottoporre alla Vostra cortese attenzione il mio interesse ad un’eventuale assunzione nella Vostra Azienda, leader nel settore della ristorazione. Come potete vedere dal Curriculum vitae che allego, dopo aver conseguito il diploma alberghiero ho svolto un tirocinio per approfondire le conoscenze nel servizio di sala e parlo abbastanza bene il tedesco e l’inglese. Sono disponibile fin da subito anche per un’assunzione a tempo determinato o con contratto di Formazione e Lavoro. Sono altresì disponibile a frequentare eventuali corsi di formazione ed a fare trasferte anche all’estero. Spero pertanto che vorrete considerare la mia candidatura.@@@"
        ,""));
        // CREATION QUESTION
        $questionnaire_B2_10_1 = $this->createQuestion("TVFNM", $questionnaire_B2_10);
        // CREATION SUBQUESTION
        $questionnaire_B2_10_1_1 = $this->createSubquestion("VFNM", $questionnaire_B2_10_1, "1. Nella lettera di candidatura, Luca scrive di avere conseguito un’esperienza formativa come cameriere di sala.");
        $questionnaire_B2_10_1_2 = $this->createSubquestion("VFNM", $questionnaire_B2_10_1, "2. Luca ha già operato nel settore del servizio di sala.");
        $questionnaire_B2_10_1_3 = $this->createSubquestion("VFNM", $questionnaire_B2_10_1, "3. Luca scrive di volere solo un impiego a lungo termine.");
        // CREATION PROPOSITIONS
        $questionnaire_B2_10_1_1_1 = $this->createProposition("VRAI", true, $questionnaire_B2_10_1_1);
        $questionnaire_B2_10_1_1_2 = $this->createProposition("FAUX", false, $questionnaire_B2_10_1_1);
        $questionnaire_B2_10_1_1_3 = $this->createProposition("ND", false, $questionnaire_B2_10_1_1);

        $questionnaire_B2_10_1_2_1 = $this->createProposition("VRAI", true, $questionnaire_B2_10_1_2);
        $questionnaire_B2_10_1_2_2 = $this->createProposition("FAUX", false, $questionnaire_B2_10_1_2);
        $questionnaire_B2_10_1_2_3 = $this->createProposition("ND", false, $questionnaire_B2_10_1_2);

        $questionnaire_B2_10_1_3_1 = $this->createProposition("VRAI", false, $questionnaire_B2_10_1_3);
        $questionnaire_B2_10_1_3_2 = $this->createProposition("FAUX", true, $questionnaire_B2_10_1_3);
        $questionnaire_B2_10_1_3_3 = $this->createProposition("ND", false, $questionnaire_B2_10_1_3);

        /*******************************************
                    QUESTIONNAIRE 11 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_11 = $this->createQuestionnaire("B2_CE_bryan_may", "B2", "CE", $test);
        $questionnaire_B2_11->setMediaInstruction($this->mediaText("", "Completa il testo usando le parole suggerite", ""));
        $questionnaire_B2_11->setMediaContext($this->mediaText("", "Articolo su rivista di musica", ""));
        $questionnaire_B2_11->setMediaText($this->mediaText("Brian May dei Queen avrebbe voluto suonare negli AC/DC",
        "Il chitarrista dei Queen Brian May ha rivelato che 1.________________________ suonare negli AC/DC.@@@In un'intervista al quotidiano britannico The Independent May ha detto che se non fosse stato  per l'impegno con Freddy Mercury e compagni non gli 2.____________________ fare qualcosa con la band australiana, ma ha anche aggiunto che probabilmente non sarebbe stato adatto per il gruppo: \"Mi sarebbe piaciuto  lavorare con gli AC/DC [se non ci  3.__________________________ i Queen]. Ma sfortunatamente sono della forma e della taglia sbagliate\"",
        ""));
        // CREATION QUESTION
        $questionnaire_B2_11_1 = $this->createQuestion("TQRU", $questionnaire_B2_11);
        // CREATION SUBQUESTION
        $questionnaire_B2_11_1_1 = $this->createSubquestion("QRU", $questionnaire_B2_11_1, "");
        $questionnaire_B2_11_1_2 = $this->createSubquestion("QRU", $questionnaire_B2_11_1, "");
        $questionnaire_B2_11_1_3 = $this->createSubquestion("QRU", $questionnaire_B2_11_1, "");

        // CREATION PROPOSITIONS
        $questionnaire_B2_11_1_1_1 = $this->createProposition("1.1. avrebbe voluto", true, $questionnaire_B2_11_1_1);
        $questionnaire_B2_11_1_1_2 = $this->createProposition("1.2. avesse voluto", false, $questionnaire_B2_11_1_1);
        $questionnaire_B2_11_1_1_3 = $this->createProposition("1.3. volle", false, $questionnaire_B2_11_1_1);

        $questionnaire_B2_11_1_2_1 = $this->createProposition("2.1. sarebbe dispiaciuto", true, $questionnaire_B2_11_1_2);
        $questionnaire_B2_11_1_2_2 = $this->createProposition("2.2. fosse dispiaciuto", false, $questionnaire_B2_11_1_2);
        $questionnaire_B2_11_1_2_3 = $this->createProposition("2.3. dispiacesse", false, $questionnaire_B2_11_1_2);

        $questionnaire_B2_11_1_3_1 = $this->createProposition("3.1. furono", false, $questionnaire_B2_11_1_3);
        $questionnaire_B2_11_1_3_2 = $this->createProposition("3.2. sarebbero stati", false, $questionnaire_B2_11_1_3);
        $questionnaire_B2_11_1_3_3 = $this->createProposition("3.3. fossero stati ", true, $questionnaire_B2_11_1_3);


        /*******************************************
                    QUESTIONNAIRE 12 : TVFNM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_12 = $this->createQuestionnaire("B2_CE_yeux_sur_saturne", "B2", "CE", $test);
        $questionnaire_B2_12->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere, false o non dette", ""));
        $questionnaire_B2_12->setMediaContext($this->mediaText("", "Articolo su rivista di eventi culturali", ""));
        $questionnaire_B2_12->setMediaText($this->mediaText("Occhi su Saturno", "Sabato 18 Maggio, una sera per mostrare Saturno all’Italia@@@
La sera del 18 Maggio cerca l'evento a te più vicino e scopri dal vivo Saturno, senza dubbio il più bel pianeta del Sistema Solare, generazioni di astronomi hanno posato gli occhi su di lui. Ora grazie alle sonde spaziali abbiamo una visione senza precedenti di Saturno, dei suoi anelli e dei suoi satelliti. Ma lo splendore di questo pianeta è folgorante anche se osservato con un piccolo telescopio.
", ""));
        // CREATION QUESTION
        $questionnaire_B2_12_1 = $this->createQuestion("TVFNM", $questionnaire_B2_12);
        // CREATION SUBQUESTION
        $questionnaire_B2_12_1_1 = $this->createSubquestion("VFNM", $questionnaire_B2_12_1, "1. “Occhi su Saturno” è un’iniziativa organizzata da un gruppo di astronomi.");
        $questionnaire_B2_12_1_2 = $this->createSubquestion("VFNM", $questionnaire_B2_12_1, "2. L’iniziativa non sarà solo locale, ma avrà luogo anche in diverse regioni italiane.");
        $questionnaire_B2_12_1_3 = $this->createSubquestion("VFNM", $questionnaire_B2_12_1, "3. Il pianeta sarà visibile ad occhio nudo.");
        // CREATION PROPOSITIONS
        $questionnaire_B2_12_1_1_1 = $this->createProposition("VRAI", false, $questionnaire_B2_12_1_1);
        $questionnaire_B2_12_1_1_2 = $this->createProposition("FAUX", false, $questionnaire_B2_12_1_1);
        $questionnaire_B2_12_1_1_3 = $this->createProposition("ND", true, $questionnaire_B2_12_1_1);

        $questionnaire_B2_12_1_2_1 = $this->createProposition("VRAI", true, $questionnaire_B2_12_1_2);
        $questionnaire_B2_12_1_2_2 = $this->createProposition("FAUX", false, $questionnaire_B2_12_1_2);
        $questionnaire_B2_12_1_2_3 = $this->createProposition("ND", false, $questionnaire_B2_12_1_2);

        $questionnaire_B2_12_1_3_1 = $this->createProposition("VRAI", false, $questionnaire_B2_12_1_3);
        $questionnaire_B2_12_1_3_2 = $this->createProposition("FAUX", true, $questionnaire_B2_12_1_3);
        $questionnaire_B2_12_1_3_3 = $this->createProposition("ND", false, $questionnaire_B2_12_1_3);


        /*******************************************
                    QUESTIONNAIRE 15 : QRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_15 = $this->createQuestionnaire("B2_CE_gerondif", "B2", "CE", $test);
        $questionnaire_B2_15->setMediaInstruction($this->mediaText("", "Completa il testo con le parole suggerite. Attenzione: ci sono due intrusi", ""));
        $questionnaire_B2_15->setMediaContext($this->mediaText("", "Estratto da un romanzo", ""));
        $questionnaire_B2_15->setMediaText($this->mediaText("Un incidente", "1. ______ Maria rientrava a casa ha visto una macchina avvicinarsi a grande velocità da Piazza S.Silvestro.@@@
2. _______ Maria aveva capito che la macchina non si sarebbe fermata per lasciarla passare, ha indietreggiato di qualche passo.@@@
3.________ Maria avesse lasciato lo spazio sufficiente, il conducente ha perso per un istante il controllo della macchina e ha urtato contro il suo piede.@@@
4. Il medico ha consigliato a Maria di usare le stampelle, spiegandole che ______ non le avesse utilizzate, avrebbe finito per peggiorare le condizioni della sua gamba.?",
""));
        // CREATION QUESTION
        $questionnaire_B2_15_1 = $this->createQuestion("QRU", $questionnaire_B2_15);
        // CREATION SUBQUESTION
        $questionnaire_B2_15_1_1 = $this->createSubquestion("QRU", $questionnaire_B2_15_1, "Il servizio permette di");

        // CREATION PROPOSITIONS
        $questionnaire_B2_15_1_1_1 = $this->createProposition("dunque", false, $questionnaire_B2_15_1_1);
        $questionnaire_B2_15_1_1_2 = $this->createProposition("nonostante", true, $questionnaire_B2_15_1_1);
        $questionnaire_B2_15_1_1_3 = $this->createProposition("mentre", true, $questionnaire_B2_15_1_1);
        $questionnaire_B2_15_1_1_3 = $this->createProposition("inoltre", false, $questionnaire_B2_15_1_1);
        $questionnaire_B2_15_1_1_3 = $this->createProposition("se", true, $questionnaire_B2_15_1_1);
        $questionnaire_B2_15_1_1_3 = $this->createProposition("siccome", true, $questionnaire_B2_15_1_1);


        /*******************************************
                    QUESTIONNAIRE 17 : APPTT
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_17 = $this->createQuestionnaire("B2_CE_superstitions_italie", "B2", "CE", $test);
        $questionnaire_B2_17->setMediaInstruction($this->mediaText("", "Ricostruisci le frasi", ""));
        $questionnaire_B2_17->setMediaContext($this->mediaText("", "Post su blog personale", ""));
        $questionnaire_B2_17->setMediaText($this->mediaText("Superstizioni in Italia", "Le forme di superstizione sono numerosissime in Italia, spesso legate alla vita quotidiana e in molti casi bizzarre. Ecco una lista delle più comuni.@@@
1. Mangiare lenticchie a Capodanno porta fortuna per il nuovo anno@@@
2. È presagio di sventura aprire l’ombrello in casa@@@
3.Posare il pane a rovescio sulla tavola, porta carestia.@@@
4. Il quadrifoglio porta fortuna e felicità ma non lo si deve cogliere@@@
5. Porta sfortuna passare sotto una scala@@@
6. Rompere uno specchio preannuncia sette anni di guai@@@
7. Quando si vede una stella cadente, si può esprimere un desiderio", ""));
        // CREATION QUESTION
        $questionnaire_B2_17_1 = $this->createQuestion("APPTT", $questionnaire_B2_17);
        // CREATION SUBQUESTION
        $questionnaire_B2_17_1_1 = $this->createSubquestion("APPTT", $questionnaire_B2_17_1, "1. Si teme che rompere uno specchio");
        $questionnaire_B2_17_1_2 = $this->createSubquestion("APPTT", $questionnaire_B2_17_1, "2. A capodanno si usa mangiare lenticchie affinché");
        $questionnaire_B2_17_1_3 = $this->createSubquestion("APPTT", $questionnaire_B2_17_1, "3. Si crede che vedere una stella cadente");
        $questionnaire_B2_17_1_4 = $this->createSubquestion("APPTT", $questionnaire_B2_17_1, "4. Secondo molti italiani, passare sotto una scala");
        $questionnaire_B2_17_1_5 = $this->createSubquestion("APPTT", $questionnaire_B2_17_1, "5. Aprire l’ombrello in casa");
        $questionnaire_B2_17_1_6 = $this->createSubquestion("APPTT", $questionnaire_B2_17_1, "6. Trovare un quadrifoglio è segno di felicità e fortuna, purché");
        $questionnaire_B2_17_1_7 = $this->createSubquestion("APPTT", $questionnaire_B2_17_1, "7. Quando si è a tavola è importante controllare che");
        // CREATION PROPOSITIONS
        $questionnaire_B2_17_1_1_1 = $this->createProposition("a. il nuovo anno sia ricco.", false, $questionnaire_B2_17_1_1);
        $questionnaire_B2_17_1_1_2 = $this->createProposition("a. il nuovo anno sia ricco.", false, $questionnaire_B2_17_1_2);
        $questionnaire_B2_17_1_1_3 = $this->createProposition("a. il nuovo anno sia ricco.", false, $questionnaire_B2_17_1_3);
        $questionnaire_B2_17_1_1_4 = $this->createProposition("a. il nuovo anno sia ricco.", false, $questionnaire_B2_17_1_4);
        $questionnaire_B2_17_1_1_5 = $this->createProposition("a. il nuovo anno sia ricco.", false, $questionnaire_B2_17_1_5);
        $questionnaire_B2_17_1_1_6 = $this->createProposition("a. il nuovo anno sia ricco.", true, $questionnaire_B2_17_1_6);
        $questionnaire_B2_17_1_1_7 = $this->createProposition("a. il nuovo anno sia ricco.", false, $questionnaire_B2_17_1_7);

        $questionnaire_B2_17_1_2_1 = $this->createProposition("b. il pane non sia al rovescio.", true, $questionnaire_B2_17_1_1);
        $questionnaire_B2_17_1_2_2 = $this->createProposition("b. il pane non sia al rovescio.", false, $questionnaire_B2_17_1_2);
        $questionnaire_B2_17_1_2_3 = $this->createProposition("b. il pane non sia al rovescio.", false, $questionnaire_B2_17_1_3);
        $questionnaire_B2_17_1_2_4 = $this->createProposition("b. il pane non sia al rovescio.", false, $questionnaire_B2_17_1_4);
        $questionnaire_B2_17_1_2_5 = $this->createProposition("b. il pane non sia al rovescio.", false, $questionnaire_B2_17_1_5);
        $questionnaire_B2_17_1_2_6 = $this->createProposition("b. il pane non sia al rovescio.", false, $questionnaire_B2_17_1_6);
        $questionnaire_B2_17_1_2_7 = $this->createProposition("b. il pane non sia al rovescio.", false, $questionnaire_B2_17_1_7);

        $questionnaire_B2_17_1_3_1 = $this->createProposition("c. porta sfortuna.", false, $questionnaire_B2_17_1_1);
        $questionnaire_B2_17_1_3_2 = $this->createProposition("c. porta sfortuna.", false, $questionnaire_B2_17_1_2);
        $questionnaire_B2_17_1_3_3 = $this->createProposition("c. porta sfortuna.", false, $questionnaire_B2_17_1_3);
        $questionnaire_B2_17_1_3_4 = $this->createProposition("c. porta sfortuna.", false, $questionnaire_B2_17_1_4);
        $questionnaire_B2_17_1_3_5 = $this->createProposition("c. porta sfortuna.", true, $questionnaire_B2_17_1_5);
        $questionnaire_B2_17_1_3_6 = $this->createProposition("c. porta sfortuna.", false, $questionnaire_B2_17_1_6);
        $questionnaire_B2_17_1_3_7 = $this->createProposition("c. porta sfortuna.", false, $questionnaire_B2_17_1_7);

        $questionnaire_B2_17_1_4_1 = $this->createProposition("d. lo si lasci al suo posto", false, $questionnaire_B2_17_1_1);
        $questionnaire_B2_17_1_4_2 = $this->createProposition("d. lo si lasci al suo posto", false, $questionnaire_B2_17_1_2);
        $questionnaire_B2_17_1_4_3 = $this->createProposition("d. lo si lasci al suo posto", false, $questionnaire_B2_17_1_3);
        $questionnaire_B2_17_1_4_4 = $this->createProposition("d. lo si lasci al suo posto", false, $questionnaire_B2_17_1_4);
        $questionnaire_B2_17_1_4_5 = $this->createProposition("d. lo si lasci al suo posto", false, $questionnaire_B2_17_1_5);
        $questionnaire_B2_17_1_4_6 = $this->createProposition("d. lo si lasci al suo posto", false, $questionnaire_B2_17_1_6);
        $questionnaire_B2_17_1_4_7 = $this->createProposition("d. lo si lasci al suo posto", true, $questionnaire_B2_17_1_7);

        $questionnaire_B2_17_1_5_1 = $this->createProposition("e. rappresenti un’occasione per formulare un progetto da realizzare", false, $questionnaire_B2_17_1_1);
        $questionnaire_B2_17_1_5_2 = $this->createProposition("e. rappresenti un’occasione per formulare un progetto da realizzare", false, $questionnaire_B2_17_1_2);
        $questionnaire_B2_17_1_5_3 = $this->createProposition("e. rappresenti un’occasione per formulare un progetto da realizzare", false, $questionnaire_B2_17_1_3);
        $questionnaire_B2_17_1_5_4 = $this->createProposition("e. rappresenti un’occasione per formulare un progetto da realizzare", false, $questionnaire_B2_17_1_4);
        $questionnaire_B2_17_1_5_5 = $this->createProposition("e. rappresenti un’occasione per formulare un progetto da realizzare", false, $questionnaire_B2_17_1_5);
        $questionnaire_B2_17_1_5_6 = $this->createProposition("e. rappresenti un’occasione per formulare un progetto da realizzare", false, $questionnaire_B2_17_1_6);
        $questionnaire_B2_17_1_5_7 = $this->createProposition("e. rappresenti un’occasione per formulare un progetto da realizzare", true, $questionnaire_B2_17_1_7);


        /*******************************************
                    QUESTIONNAIRE 25 : TVFNM
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_25 = $this->createQuestionnaire("B2_CE_vademecum", "B2", "CE", $test);
        $questionnaire_B2_25->setMediaInstruction($this->mediaText("", "Indica se le affermazioni sono vere, false o non dette", ""));
        $questionnaire_B2_25->setMediaContext($this->mediaText("", "Brochure informativa delle elezioni amministrative", ""));
        $questionnaire_B2_25->setMediaText($this->mediaText("Vademecum delle elezioni amministrative", "**Come si vota nei comuni con popolazione superiore ai 15.000 abitanti**@@@La scheda per il rinnovo del Consiglio comunale č di colore azzurro. L'elettore ha a disposizione diverse modalitŕ per esprimere la propria preferenza.@@@1- Votare solo per un candidato sindaco, tracciando un segno sul nome, non scegliendo alcuna lista collegata. Il voto cosě espresso si intende attribuito solo al candidato sindaco.@@@2- Votare solo per una delle liste, tracciando un segno sul relativo simbolo. Il voto cosě espresso si intende attribuito anche al candidato sindaco collegato.@@@3- Votare per un candidato sindaco, tracciando un segno sul nome, e per una delle liste a esso collegate, tracciando un segno sul contrassegno della lista prescelta. Il voto cosě espresso si intende attribuito sia al candidato sindaco sia alla lista collegata.",
        ""));
        // CREATION QUESTION
        $questionnaire_B2_25_1 = $this->createQuestion("TVFNM", $questionnaire_B2_25);
        // CREATION SUBQUESTION
        $questionnaire_B2_25_1_1 = $this->createSubquestion("VFNM", $questionnaire_B2_25_1, "1. Č possibile votare per il sindaco e per le liste scegliendo solo il simbolo del partito di cui č a capo.");
        $questionnaire_B2_25_1_2 = $this->createSubquestion("VFNM", $questionnaire_B2_25_1, "2. Č possibile votare per due partiti che fanno parte della stessa coalizione.");
        $questionnaire_B2_25_1_3 = $this->createSubquestion("VFNM", $questionnaire_B2_25_1, "3. Č possibile votare per un solo candidato scrivendo il suo nome sulla scheda");
        // CREATION PROPOSITIONS
        $questionnaire_B2_25_1_1_1 = $this->createProposition("VRAI", true, $questionnaire_B2_25_1_1);
        $questionnaire_B2_25_1_1_2 = $this->createProposition("FAUX", false, $questionnaire_B2_25_1_1);
        $questionnaire_B2_25_1_1_3 = $this->createProposition("ND", false, $questionnaire_B2_25_1_1);

        $questionnaire_B2_25_1_2_1 = $this->createProposition("VRAI", false, $questionnaire_B2_25_1_2);
        $questionnaire_B2_25_1_2_2 = $this->createProposition("FAUX", false, $questionnaire_B2_25_1_2);
        $questionnaire_B2_25_1_2_3 = $this->createProposition("ND", true, $questionnaire_B2_25_1_2);

        $questionnaire_B2_25_1_3_1 = $this->createProposition("VRAI", false, $questionnaire_B2_25_1_3);
        $questionnaire_B2_25_1_3_2 = $this->createProposition("FAUX", true, $questionnaire_B2_25_1_3);
        $questionnaire_B2_25_1_3_3 = $this->createProposition("ND", false, $questionnaire_B2_25_1_3);



        /*******************************************
                    QUESTIONNAIRE 26 : APPTT
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_26 = $this->createQuestionnaire("B2_CE_voisin_greta", "B2", "CE", $test);
        $questionnaire_B2_26->setMediaInstruction($this->mediaText("", "Abbina ad ogni parola la definizione corretta. Ci sono due intrusi", ""));
        $questionnaire_B2_26->setMediaContext($this->mediaText("", "Post su un blog personale", ""));
        $questionnaire_B2_26->setMediaText($this->mediaText("Riflessione in treno", "In treno mi piace chiudere gli occhi e ascoltare la gente che urla faccende private, intimi segreti a tutta la carrozza. Non per quello che dicono ma per come lo dicono. Per una rubrica come questa le ferrovie sono una grande fonte di ispirazione. Solo che dovremmo cambiare il Titolo: invece che tre minuti una parola, tre ore e migliaia di parole, nel viaggio solo da Milano a Roma. Molte sono superflue ma alcune sono sintomatiche. Il mio vicino nel corso interminabile di una telefonata, più o meno a distanza Parma - Firenze, continuava a ripetere agitato: ma si figuri, ma si figuri, ma si figuri! Non so cosa si figurasse il misterioso interlocutore: io mi figuravo un figuro che temeva una figuraccia", ""));
        // CREATION QUESTION
        $questionnaire_B2_26_1 = $this->createQuestion("APPTT", $questionnaire_B2_26);
        // CREATION SUBQUESTION
        $questionnaire_B2_26_1_1 = $this->createSubquestion("APPTT", $questionnaire_B2_26_1, "Figurasi");
        $questionnaire_B2_26_1_2 = $this->createSubquestion("APPTT", $questionnaire_B2_26_1, "Figuro");
        $questionnaire_B2_26_1_3 = $this->createSubquestion("APPTT", $questionnaire_B2_26_1, "Figuraccia");
        // CREATION PROPOSITIONS
        $questionnaire_B2_26_1_1_1 = $this->createProposition("Personaggio famoso", false, $questionnaire_B2_26_1_1);
        $questionnaire_B2_26_1_1_2 = $this->createProposition("Personaggio famoso", false, $questionnaire_B2_26_1_2);
        $questionnaire_B2_26_1_1_3 = $this->createProposition("Personaggio famoso", false, $questionnaire_B2_26_1_3);

        $questionnaire_B2_26_1_2_1 = $this->createProposition("Buona impressione", false, $questionnaire_B2_26_1_1);
        $questionnaire_B2_26_1_2_2 = $this->createProposition("Buona impressione", false, $questionnaire_B2_26_1_2);
        $questionnaire_B2_26_1_2_3 = $this->createProposition("Buona impressione", false, $questionnaire_B2_26_1_3);

        $questionnaire_B2_26_1_3_1 = $this->createProposition("Individuo losco", false, $questionnaire_B2_26_1_1);
        $questionnaire_B2_26_1_3_2 = $this->createProposition("Individuo losco", true, $questionnaire_B2_26_1_2);
        $questionnaire_B2_26_1_3_3 = $this->createProposition("Individuo losco", false, $questionnaire_B2_26_1_3);

        $questionnaire_B2_26_1_4_1 = $this->createProposition("Azione inopportuna", false, $questionnaire_B2_26_1_1);
        $questionnaire_B2_26_1_4_2 = $this->createProposition("Azione inopportuna", false, $questionnaire_B2_26_1_2);
        $questionnaire_B2_26_1_4_3 = $this->createProposition("Azione inopportuna", true, $questionnaire_B2_26_1_3);

        $questionnaire_B2_26_1_5_1 = $this->createProposition("Rappresentare", false, $questionnaire_B2_26_1_1);
        $questionnaire_B2_26_1_5_2 = $this->createProposition("Rappresentare", false, $questionnaire_B2_26_1_2);
        $questionnaire_B2_26_1_5_3 = $this->createProposition("Rappresentare", false, $questionnaire_B2_26_1_3);

        $questionnaire_B2_26_1_6_1 = $this->createProposition("Immaginare", true, $questionnaire_B2_26_1_1);
        $questionnaire_B2_26_1_6_2 = $this->createProposition("Immaginare", false, $questionnaire_B2_26_1_2);
        $questionnaire_B2_26_1_6_3 = $this->createProposition("Immaginare", false, $questionnaire_B2_26_1_3);


        /*******************************************
                    QUESTIONNAIRE 27 : TQRU
        ********************************************/
        // CREATION QUESTIONNAIRE
        $questionnaire_B2_27 = $this->createQuestionnaire("B2_CE_enfin_les_pierres_volent", "B2", "CE", $test);
        $questionnaire_B2_27->setMediaInstruction($this->mediaText("", "Rispondi alle domande. Una sola risposta è corretta.", ""));
        $questionnaire_B2_27->setMediaContext($this->mediaText("", "Post su blog di viaggi", ""));
        $questionnaire_B2_27->setMediaText($this->mediaText("I sassi finalmente volano",
        "I sassi di Matera sono un’attrazione turistica da sempre molto forte. Ma avete mai provato a guardarli da una nuova prospettiva? L’evento “I Sassi finalmente volano”, dal 18 marzo al 1°aprile, propone voli in mongolfiera per ammirare il paesaggio antropologico di quella che è stata definita la città più antica del mondo. 30 mongolfiere che si librano in volo al soffio del vento e fanno vedere e vivere dall’alto l’inusuale paesaggio rupestre della Città dei Sassi, patrimonio dell’umanità Unesco. Inoltre, dal 18 al 24 marzo, è previsto un evento di Light Mobility a favore di una consapevole ed ecosostenibile mobilità turistica.", ""));
        // CREATION QUESTION
        $questionnaire_B2_27_1 = $this->createQuestion("TQRU", $questionnaire_B2_27);
        // CREATION SUBQUESTION
        $questionnaire_B2_27_1_1 = $this->createSubquestion("QRU", $questionnaire_B2_27_1, "**1. L’articolo parla di un evento a Matera in cui:**");
        $questionnaire_B2_27_1_2 = $this->createSubquestion("QRU", $questionnaire_B2_27_1, "**2. L’evento:**");
        $questionnaire_B2_27_1_3 = $this->createSubquestion("QRU", $questionnaire_B2_27_1, "**3. Dal 18 al 24 marzo viene inoltre proposta:**");


        // CREATION PROPOSITIONS
        $questionnaire_B2_27_1_1_1 = $this->createProposition("1.1. dall’alto delle mongolfiere vengono lanciati dei sassi contro dei bersagli.", false, $questionnaire_11_1_1);
        $questionnaire_B2_27_1_1_2 = $this->createProposition("1.2. dei giri in mongolfiera partono da Matera per visitare la regione della Basilicata.", false, $questionnaire_11_1_1);
        $questionnaire_B2_27_1_1_3 = $this->createProposition("1.3. dei giri in mongolfiera vengono organizzati per godere della veduta della città.", true, $questionnaire_11_1_1);
        $questionnaire_B2_27_1_1_4 = $this->createProposition("1.4. dei giri in mongolfiera vengono organizzati per promuovere il trasporto ecologico.", false, $questionnaire_11_1_1);

        $questionnaire_B2_27_1_2_1 = $this->createProposition("2.1. attrae da diversi anni  molti turisti.", false, $questionnaire_B2_27_1_2);
        $questionnaire_B2_27_1_2_2 = $this->createProposition("2.2. è una novità turistica", true, $questionnaire_B2_27_1_2);
        $questionnaire_B2_27_1_2_3 = $this->createProposition("2.3. è alla sua ultima edizione", false, $questionnaire_B2_27_1_2);
        $questionnaire_B2_27_1_2_3 = $this->createProposition("2.4. fa parte della tradizione della città.", false, $questionnaire_B2_27_1_2);

        $questionnaire_B2_27_1_3_1 = $this->createProposition("3.1. una visita guidata turistica di Matera, detta anche città dei Sassi.", false, $questionnaire_B2_27_1_3);
        $questionnaire_B2_27_1_3_2 = $this->createProposition("3.2. un evento che promuove la raccolta differenziata nella città di Matera.", false, $questionnaire_B2_27_1_3);
        $questionnaire_B2_27_1_3_3 = $this->createProposition("3.3. un evento che promuove  un risparmio delle risorse energetiche.", false, $questionnaire_B2_27_1_3);
        $questionnaire_B2_27_1_3_3 = $this->createProposition("3.4. un evento che promuove  una gestione ecologica dei visitatori.", true, $questionnaire_B2_27_1_3);


        /*******************************************
                    MISE EN BASE
        ********************************************/
        $em->flush();

        $output->writeln("Fixtures Italian CE exécutées.");


    }

    /**
     *
     */
    protected function createTest($name, $language)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $test = new Test();
        $test->setName($name);
        $language = $em->getRepository('InnovaSelfBundle:Language')->findOneByName($language);
        $test->setLanguage($language);
        $em->persist($test);

        return $test;
    }

    /**
     *
     */
    protected function createQuestionnaire($title, $level, $skill, $test)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $questionnaire = new Questionnaire();

        $questionnaire->addTest($test);

        $questionnaire->setTheme($title);

        $level = $em->getRepository('InnovaSelfBundle:Level')->findOneByName($level);
        $questionnaire->setLevel($level);

        // Traitement sur le skill
        $skill = $em->getRepository('InnovaSelfBundle:Skill')->findOneByName($skill);
        $questionnaire->setSkill($skill);


        $questionnaire->setAuthor();
        $questionnaire->setInstruction();
                        $questionnaire->setDuration();
                        $questionnaire->setDomain();
                        $questionnaire->setSupport();
                        $questionnaire->setFlow();
                        $questionnaire->setFocus();
                        $questionnaire->setSource();
                        $questionnaire->setListeningLimit(0); //ListeningLimit
                        $questionnaire->setDialogue(0);


        $em->persist($questionnaire);

        return $questionnaire;
    }

    /**
     *
     */
    protected function createQuestion($typology, $questionnaire)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $question = new Question();

        $typo = $em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology);
        $question->setTypology($typo);

        $question->setQuestionnaire($questionnaire);

        $em->persist($question);

        return $question;
    }

    /**
     *
     */
    protected function createSubquestion($typology, $question, $amorce)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $subquestion = new Subquestion();

        $typo = $em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology);
        $subquestion->setTypology($typo);

        $subquestion->setQuestion($question);

        if ($amorce != '') {
            $subquestion->setMediaAmorce($this->mediaText("", $amorce, ""));
        }

        $em->persist($subquestion);

        return $subquestion;
    }

    /**
     *
     */
    protected function createSubquestionVF($typology, $question, $amorce, $media)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // Création du questionnaire
        $subquestion = new Subquestion();

        $typo = $em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology);
        $subquestion->setTypology($typo);

        $subquestion->setQuestion($question);

        if ($amorce != '') {
            $subquestion->setMediaAmorce($this->mediaText("", $amorce, ""));
        }
        if ($media != '') {
            $subquestion->setMedia($this->mediaText("", $media, ""));
        }

        $em->persist($subquestion);

        return $subquestion;
    }

    /**
     *
     */
    protected function createProposition($text, $rightAnswer, Subquestion $subquestion)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $proposition = new Proposition();

        $proposition->setSubquestion($subquestion);
        $proposition->setMedia($this->mediaText("", $text, ""));
        $proposition->setRightAnswer($rightAnswer);

        $em->persist($proposition);

        return $proposition;
    }


    /**
     *createPropositionVF()
     */
    protected function createPropositionVF($text, $textAnswer, $rightAnswer, Subquestion $subquestion)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $proposition = new Proposition();

        $proposition->setSubquestion($subquestion);
        $proposition->setMedia($this->mediaText("", $textAnswer, ""));
        $proposition->setRightAnswer($rightAnswer);

        $em->persist($proposition);

        return $proposition;
    }

    /**
     *
     */
    protected function mediaText($title, $name, $type)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        // TODO : l'appel à la fonction qui traite le markdown !!
        // Création dans "Media"
        $media = new Media();

        if ($type != "") {
            $media->setMediaType($em->getRepository('InnovaSelfBundle:MediaType')->findOneByName("image"));
            $media->setUrl($name.".jpg");
        }
        else
        {
            $media->setMediaType($em->getRepository('InnovaSelfBundle:MediaType')->findOneByName("texte"));
            $media->setUrl(NULL);
        }

        $media->setName($this->textSource($title.$name));
        $media->setDescription($this->textSource($title.$name)); // Ajout ERV 03/03/2014 car c'est la description que l'on affiche dans la macro.texte

        $em->persist($media);

        return $media;
    }

    /**
     * textSource function
     *
     */
    private function textSource($textSource)
    {

        // Règles :
        // *** pour un texte italique
        // $$$ pour un texte souligné
        // @@@ pour aller à la ligne
        //
        //
        // For more explications : http://www.php.net/manual/fr/reference.pcre.pattern.modifiers.php
        // echo "<br /><br />Texte AVANT = " . $textSource;
        //$rule = '($$$).*?($$$)';
        //$final = '<i>.*?</i>';

        $textDisplay = preg_replace('/\*{3}(.*?)\*{3}/s', '<i>$1</i>', $textSource);
        // echo "<br /><br />Texte APRES = " . $textDisplay;

        // echo "<br /><br />Texte AVANT = " . $textSource;
        $textDisplay = preg_replace('/\${3}(.*?)\${3}/s', '<u>$1</u>', $textDisplay);
        //$textDisplay = preg_replace('/***(.*?)***/s', '<i>$1</i>', $textSource); // Texte italique

        $textDisplay = str_replace('@@@', '<br>', $textDisplay); // Saut de ligne

        // echo "<br /><br />Texte APRES = " . $textDisplay;

        return $textDisplay;
    }

}