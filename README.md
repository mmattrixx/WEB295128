# ECT Biblioteka pomiarów
## Odporność na zgniatanie kolumnowe – krawędziowe ECT
###### ECT to wskaźnik odporności tektury falistej na zgniatanie krawędziowe [inaczej także kolumnowe]. To drugi najważniejszy parametr określający z jakiej klasy produktem mamy do czynienia. ECT wyraża się w kN na 1 w kw. i w zależności od rynku, badanie ECT może mieć nieco inny przebieg. Norma PN-EN ISO 3037:2000 wskazuje jednak, że pomiar sprowadza się do umieszczenia tektury falistej między dwoma płytami zgniatającymi (tektura położona prostopadle do płyt zgniatających) aż do chwili, w której arkusz papieru ulega załamaniu. ECT wyraża w praktyce maksymalną siłę zgniatania, w jakiej nie dochodzi do trwałego odkształcenia – zniszczenia tektury.
###### Kluczowy wpływ na wartość ECT ma klasa papieru wykorzystana do produkcji. Można przyjąć za regułę, że niższą odporność na zgniatanie kolumnowe – krawędziowe wykazuje tektura falista, do której wykorzystano arkusze papieru z recyklingu (włókien obróbki wtórnej).
## Cel Programu 
    Program ma za zadanie przechowywać dane uzyskane z urządzenia do pomiarów ECT  
    oraz uzupełniać dane które nie są zawartę w  pomiarze 
## Działanie programu 
     Osoba kontroli jakości wykonuje pomiar na urządzeniu które zwraca informacje w pliku *.inf
     Osoba kontrolująca wprowadza pomiar do systemu , uzupełnia brakujące dane tj. 
     wykorzystany typ tektury , rodzaj papieru na każdej fali i pokryciu ,numer zlecenia,grubość 
     i wilgotność tektury
     Wszystkie dane wprowadzane są dostępnie na stronie , domyślnie wyświetla się 200 ostatnich 
     na dany rok  
## Uprawnienia
 Dostępne są 3 poziomy uprawnień programu które są dziedziczone 
   * ROLE_ADMIN - Dodawanie i edycja użytkowników , kasowanie pomiarów 
   * ROLE_MODERATOR - dodawanie pomiarów , edycja istniejących pomiaów , dodawanie tektury i papieru 
   * ROLE_ONLYSHOW -  podgląd wyszukiwanie obecnych pomiarów 
## Dane
 Dane Tektur,Papierów oraz użytkowników można edytować 
  ale dla zachowania historii pomiarów nie można ich usuwać 
## PHP  Symfony SQL Bootstrap JQuery
   Aplikacja napisana jest w framworku Symfony 5.0.2 który wymaga min PHP 7.2.5
   niektóre metody wykorzystane są z symfony 4.4 co może być powodem
    wyświetlania w profiler warningów o deprecjonowanych metodach 
    
   Aplikacja wykorzystuje do połączenia z bazdą danych ORM Doctrine 
   aktualny serwer bazy danych to MariaDB
   
   Aplikacja wykorzystuje silnik templatów Twig , cały wygląd oparty jest na Bootstrap w wersji 4 oraz 
   jQuery v3.4.1 
## Opis Wymagań zaliczenia  WEBNSI2020
 * 500 lini kodu - w samym katalogu controlerów  [src/controller] znajduje się ponad 900 lini kodu 
 * Interfejs-Frontend
    * HTML5 
    * Bootstrap 4
        * Grid rozmieszczenie elementów zgodnie z gridem bootstrapa
        * NAV wykorzystanie responsywnego górnego menu z hamburger menu dla wersji mobilnych 
        * BTN wykorzystanie standarowych przycisków klass btn btn-success itp
        * Form-control wykorzystanie wyglądu formularzy 
        * input group  wykorzystanie do łączenia pól z przyciskami
        * modal wykorzystanie okienek dialogowych do dynamicznego dodawania tektury i papierów 
    * JQuery i JQuery UI 
        * Jquery wykorzystane w pliku Szuka.html.twig do dynamicznego ukrywania wyników wyszukiwania 
        * Jquery UI wykorzystane do obsługi Datetimepicker (date picker z HTML5 nie jest obsługiwany przez dużą część przeglądarek)
        * Jquery Ajax -wykroozystanie metod $.post do dynamicznego ładowania danych do formularzy edycja pomiarów
    * Twig Templates -podział strony na zdefiniowane szablony 
        * base.html.twig główny plik w którym trzymane są nagłówki HEAD oraz cały NAVBAR oraz prygotowane bloki do eksludowania templateów tj modal cont javascript
        * poszczególne foldery odpowiadają za kolejne grupy podstron i dalej podstrony  
  * Technologia 
    * Symfony 5 php
        * Role - na stronie istnieją 3 uprawnienia dziedziczone 
            * Admin - administracja użytkownikami , kasowanie pomiarów
            * Moderator -dodawanie i edycja pomiarów 
            * Only View - podgląd i wyszukiwanie pomiarów 
        * Annotation - wszystkie endpointy stworzone są za pomocą Routingu Symfony 
        * Fixtures  - Podstawowe dane jak domyślny użytkownik i podstawowe Tektury i pomiary dodawane są za pomocą Fixtures
  * Przechowywanie danych 
    * MySql
    * Doctrine ORM
        * Encje projektu zapisane są w symfony jako klasy php które odwzorowane są w wybranej bazie :
            * Papier - Encja przechowuje informacje o papierze tj Nazwa gramatura i Producent danej tektury
            * Tektura -Encja przechowuje ogólne dane o typie tektury oraz jej gramatury 
            * User - Encja przechowująca dane o użytkownikach 
            * Pomiary - Encja przechowująca dane o dodanych popiarach
  * Komunikacja
    * Jquery Ajax 
        * dynamiczne dodanie Tektury i Papieru podczas edycji oraz załadowanie aktualnej listy papierów i tektury
        w pliku EdycjaPomiary.html.twig
        
   

     
    
