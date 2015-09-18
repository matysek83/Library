<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
     
        <title>Operacje na plikach - by Arkadiusz Włodarczyk - videokurs.pl</title>

    </head>
    <body>
        <?php
            /*      FILE
             *     $wskaznik = fopen("nazwaPliku.txt", "TRYBEM OTWARCIA");
             *          
             *     r - (read) - otwiera nam plik do odczytu; ustawia wskaźnik (uchwyt pliku) na początek; WYMAGA ABY PLIK BYL JUZ STWORZONY
             *     r+ - robi to co wyżej + pozwala zapisywać
             * 
             *     w - (write) - otwiera plik do zapisu; ustawia wskaźnik na początku pliku. Usuwa dotychczasowa zawartość pliku; jeżeli plik nie istnieje to go tworzy!
             *     w+ - robi to co wyżej + pozwala odczytywać
             * 
             *     a - (attach) - otwiera plik do zapisu; ustawia wskaźnik na koniec pliku; jeśli plik nie istnieje to go tworzy
             *     a+ - robi to co wyżej + pozwala odczytywać
             */
             $nazwaPliku = "test.txt";
             $wskaznik = @fopen($nazwaPliku, "r+");
             
             if ($wskaznik)
             {
                 //$tresc = fread($wskaznik, filesize($nazwaPliku));
                 /*
                 while($linia = fgets($wskaznik))                 
                    echo $linia."<br />";                 */
                $licznik = (int)fread($wskaznik, filesize($nazwaPliku));
                $licznik++;
                
                rewind($wskaznik);
                fwrite($wskaznik, $licznik);
             }
             else
                 echo "Nie ma takiego pliku";
                 
            
            @fclose($wskaznik);
        ?>
    </body>
</html>