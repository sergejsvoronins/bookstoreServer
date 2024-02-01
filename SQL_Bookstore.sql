-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 01, 2024 at 01:24 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`, `created`, `modified`) VALUES
(104, 'Maria Lang', 1706458601, NULL),
(114, 'Sam Washington', 1706458601, NULL),
(117, 'Karin Carlsson', 1706458601, NULL),
(120, 'Bill Gardner', 1706458601, NULL),
(122, 'Therese Uddenfeldt', 1706458601, NULL),
(124, 'Lucy Monroe', 1706458601, NULL),
(128, 'Kimberly Lang', 1706458601, NULL),
(139, 'Lejf Moos', 1706458601, NULL),
(144, 'Christopher Tollefsen', 1706458601, NULL),
(156, 'Vladan Devedžic', 1706458601, NULL),
(158, 'Hans Uszkoreit', 1706458601, NULL),
(163, 'Ella Lang', 1706458601, NULL),
(166, 'Viktoria Stein', 1706458601, NULL),
(167, 'Douglas W. Kennard', 1706458601, NULL),
(179, 'Daniel Garrison Brinton', 1706458601, NULL),
(184, 'Nina Bonderup Dohn', 1706458601, NULL),
(191, 'Sergejs Voronins', 1706717358, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` longtext,
  `imgUrl` longtext,
  `pages` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `language` varchar(50) NOT NULL,
  `authorId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `imgUrl`, `pages`, `year`, `language`, `authorId`, `categoryId`, `price`, `isbn`, `created`, `modified`) VALUES
(15, 'Learning Python Network Programming', 'Network programming has always been a demanding task. With full-featured and well documented libraries all the way up the stack, Python makes network programming the enjoyable experience it should be. Starting with a walkthrough of today&#39;s major networking protocols, with this book you&#39;ll learn how to employ Python for network programming, how to request and retrieve web resources, and how to extract data in major formats over the Web. You&#39;ll utilize Python for e-mailing using different protocols and you&#39;ll interact with remote systems and IP and DNS networking. As the book progresses, socket programming will be covered, followed by how to design servers and the pros and cons of multithreaded and event-driven architectures. You&#39;ll develop practical client-side applications, including web API clients, e-mail clients, SSH, and FTP. These applications will also be implemented through existing web application frameworks.', 'http://books.google.com/books/content?id=0EPsCQAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 320, 2015, 'en', 114, 19, 391, '1784391158', 1706458630, NULL),
(16, 'Inga pengar till Vendela', 'Trehundratusen kronor är den lockande vinstsumman i tävlingen i kriminallitteratur. Men efter att vinnaren, Vendela, presenterats i tv hör hon aldrig av sig för att inkassera pengarna. Vad kan anledningen till en sådan sak vara? Rör det sig i själva verket om ett fall för Christer Wijk?', 'http://books.google.com/books/content?id=7vmpDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 167, 2019, 'sv', 104, 17, 157, '9113103806', 1706458630, NULL),
(19, 'Mörkögda augustinatt', 'Puck och Einar Bure har fått låna tant Otties sommarstuga i Roslagen och blir bjudna till Adèle Renmans årliga kräftskiva. Brännvinet flödar och kräftor finns i överflöd, men bjudningen slutar med ett dödsfall. Detta är bara ett av många problem som möter kriminalkommissarie Wijk när han anländer till platsen.', 'http://books.google.com/books/content?id=rYqsDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 177, 2019, 'sv', 104, 17, 157, '9113103873', 1706458630, NULL),
(20, 'Transnational Influences on Values and Practices in Nordic Educational Leadership', 'This book explores to what extent transnational influences change national/local values and practices in the Nordic educational systems. It provides country cases and thematic chapters that give nuanced insights into the influence of transnational agencies on national governance and discourses. It describes how national discourses and regulation influences school leadership values, culture and practice, in competition with traditional values. The transnational and global discourse on educational leadership is mostly formed according to Anglo-American thinking and tradition. Pivotal foundations of this discourse are strong hierarchical societies/class societies with liberal democracies, and clearly streamed education systems. The Nordic discourse, however, builds on a more equal society and flat hierarchies with participatory democracy, and on comprehensive schooling with strong local community roots. Leadership thinking and practices are formed by the culture and context they are part of: they are primarily shaped by the national/local values, traditions and practices, and only partially shaped by politics, discourses and literature. Due to the fact that a great deal of the literature that is being used in the Nordic contexts is of Anglo-American origin and many of the research projects have Anglo-American foundations, it is difficult to distinguish the sources for leadership thinking and practice. This book distinguishes the Nordic from the Anglo-American thinking and presents important findings and arguments for leadership practitioners inside as well as outside the Nordic countries.​', 'http://books.google.com/books/content?id=idNEAAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 228, 2013, 'en', 139, 28, 1068, '9400762267', 1706458630, NULL),
(21, 'Använd aldrig arsenik', 'Almi Graan har sett fram emot lite lugn och ro denna försommarvecka, när tre av hennes författarkollegor plötsligt dyker upp i Skoga för att bilda kriminalklubb. Redan från början finns motsättningar inom gruppen och ingenting blir bättre när den intolerante deckarkritikern Bjarne Bork ansluter. Vad har han egentligen i kikaren?', 'http://books.google.com/books/content?id=9vmpDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 140, 2019, 'sv', 104, 17, 157, '9113103768', 1706458630, NULL),
(22, 'Artificial Nutrition and Hydration', 'Pope John Paul II surprised much of the medical world in 2004 with his strongly worded statement insisting that patients in a persistent vegetative state should be provided with nutrition and hydration. This collection of essays featuring some of the most prominent Catholic bioethicists addresses the Pope’s statements, the moral issues surrounding artificial feeding and hydration, the refusal of treatment, and the ethics of care for those at the end of life.', 'http://books.google.com/books/content?id=3UdNlzEJXdwC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 235, 2007, 'en', 144, 33, 2480, '1402062079', 1706458630, NULL),
(23, 'Semantic Web and Education', 'This is the first book treatment on two &#34;hot button&#34; topics in Information Systems, Computer Science and Education: the application of web technology for educational use. The result is a thorough and highly useful presentation on the confluence of the technical aspects of the Semantic Web and the field of Education or the art of teaching. The book will interest researchers and students in the fields of Information Systems, Computer Science, and Education.', 'http://books.google.com/books/content?id=Rjdpb5wQu38C&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 355, 2006, 'en', 156, 19, 1186, '0387354174', 1706458630, NULL),
(24, 'Tragedi på en lantkyrkogård', 'Hemma hos kyrkoherde Tord Ekstedt på Västlinge prästgård firar man jul och i salongen delas det ut klappar. Elvaåriga dottern Lotta är överlycklig. Hon har fått en vitullig kattunge av sin kusin Puck och hennes man Eje. Julefriden är fullständig tills det ringer på ytterdörren och den vackra grannfrun Barbara Sandell berättar att hennes man Arne är försvunnen. Kort därefter hittar Puck honom i hans butik, slagen i huvudet med en yxa! Den idylliska kyrkbyn har blivit en mordplats och listan över misstänkta kan göras lång.', 'http://books.google.com/books/content?id=gnVQAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 174, 2013, 'sv', 104, 17, 157, '9113054155', 1706458630, NULL),
(25, 'Google Hacking for Penetration Testers', 'This book helps people find sensitive information on the Web. Google is one of the 5 most popular sites on the internet with more than 380 million unique users per month (Nielsen/NetRatings 8/05). But, Google’s search capabilities are so powerful, they sometimes discover content that no one ever intended to be publicly available on the Web including: social security numbers, credit card numbers, trade secrets, and federally classified documents. Google Hacking for Penetration Testers Volume 2 shows the art of manipulating Google used by security professionals and system administrators to find this sensitive information and “self-police their own organizations. Readers will learn how Google Maps and Google Earth provide pinpoint military accuracy, see how bad guys can manipulate Google to create super worms, and see how they can &#34;mash up&#34; Google with MySpace, LinkedIn, and more for passive reconaissance. • Learn Google Searching Basics Explore Google’s Web-based Interface, build Google queries, and work with Google URLs. • Use Advanced Operators to Perform Advanced Queries Combine advanced operators and learn about colliding operators and bad search-fu. • Learn the Ways of the Google Hacker See how to use caches for anonymity and review directory listings and traversal techniques. • Review Document Grinding and Database Digging See the ways to use Google to locate documents and then search within the documents to locate information. • Understand Google’s Part in an Information Collection Framework Learn the principles of automating searches and the applications of data mining. • Locate Exploits and Finding Targets Locate exploit code and then vulnerable targets. • See Ten Simple Security Searches Learn a few searches that give good results just about every time and are good for a security assessment. • Track Down Web Servers Locate and profile web servers, login portals, network hardware and utilities. • See How Bad Guys Troll for Data Find ways to search for usernames, passwords, credit card numbers, social security numbers, and other juicy information. • Hack Google Services Learn more about the AJAX Search API, Calendar, Blogger, Blog Search, and more.', 'http://books.google.com/books/content?id=bvB1-MmhEjQC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 560, 2011, 'en', 120, 19, 541, '9780080484266', 1706458630, NULL),
(26, 'The Swedish Language in the Digital Age', 'This white paper is part of a series that promotes knowledge about language technology and its potential. It addresses educators, journalists, politicians, language communities and others. The availability and use of language technology in Europe varies between languages. Consequently, the actions that are required to further support research and development of language technologies also differ for each language. The required actions depend on many factors, such as the complexity of a given language and the size of its community. META-NET, a Network of Excellence funded by the European Commission, has conducted an analysis of current language resources and technologies. This analysis focused on the 23 official European languages as well as other important national and regional languages in Europe. The results of this analysis suggest that there are many significant research gaps for each language. A more detailed expert analysis and assessment of the current situation will help maximise the impact of additional research and minimize any risks. META-NET consists of 54 research centres from 33 countries that are working with stakeholders from commercial businesses, government agencies, industry, research organisations, software companies, technology providers and European universities. Together, they are creating a common technology vision while developing a strategic research agenda that shows how language technology applications can address any research gaps by 2020.', 'http://books.google.com/books/content?id=Yf0-ikvR5mEC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 79, 2012, 'en', 158, 19, 593, '3642308325', 1706458630, NULL),
(27, 'Mördaren ljuger inte ensam', 'Rutger Hammars stuga Lillborgen ligger på Ön i sjön Uvlången i Bergslagen. Där samlar han och hans fru under en sommarhelg en handfull gäster för att umgås, bada och segla. Men när Puck Ekstedt under en promenad överraskas av ett skyfall och tvingas fly in under en gran gör hon ett makabert fynd: en av Hammars gäster ligger där strypt med en röd sidenscarf om sin hals. Pucks fästman Einar Bure beslutar att kontakta sin gamle vän Christer Wijk, kommissarie vid Stockholmspolisen, för att lösa fallet. Det visar sig att gästerna alla knyts samman genom kärleksband och svartsjuka. Alla verkar ha något att dölja, men det är bara en av dem som är mördaren.', 'http://books.google.com/books/content?id=IG1QAgAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 215, 2013, 'sv', 104, 17, 157, '9113051369', 1706458630, NULL),
(28, 'Stockholm Sin: Midsommar på Skansen', 'Jennifer är utbytesstudent från USA och har verkligen sett framemot att fira midsommar med sina svenska vänner innan hon åker tillbaka hem. Bland vännerna finns Carl med de blåa glittrande ögonen, den långa kroppen och det blonda håret. Hon har dragits till honom sedan början av skolåret och under kvällen känner Jennifer förväntningarna stiga. Efter att ha vandrat iväg ensam och hittat en liten stuga minns hon den lustfyllda anledningen till att hon åkte till Sverige och snart hittar Carl henne för att uppfylla hennes förhoppningar. Ella Lang är pseudonym för en svensk författare som gärna ger sig in i erotikens värld med sitt skrivande. I hennes uppskattade noveller får läsaren följa karaktärerna på en resa mot sexuell njutning och frigörelse. Med sitt skrivande vill hon utforska nya världar och ta sina läsare med på en kittlande resa in i fantasins gränsland, där det som annars bara finns i tanken blir levande.', 'http://books.google.com/books/content?id=m3EpEAAAQBAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 23, 2021, 'svenska', 163, 17, 11, '8726840596', 1706458630, 1706705225),
(29, 'Det är ugglor i mossen', 'Runt den isolerade stugan vid Alntorpsmossen i närheten av Skoga - bland blåbärsris och ljung, tallar och vitblommande skvattram - anas ugglor i mossen i både bokstavlig och bildlig bemärkelse. Människorna på platsen är få och mordgåtans lösning till synes enkel, men ändå gäckar ugglorna i det längsta Christer Wijk.', 'http://books.google.com/books/content?id=5vqpDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 172, 2019, 'sv', 104, 22, 157, '911310392X', 1706458630, NULL),
(30, 'En julstjärna över Atlanten del 4 - erotisk adventskalender', 'När Charlie Brofjord får reda på en hemlighet om Fredrik är det som att världen rämnar. Hon drar sig undan så mycket hon kan, men precis när hon tror att hon kommit undan sina växande känslor, sveper de in som kluckande vågor mot fartygets skrov. När allt plötsligt handlar om liv och död tvingas hon inse att hon inte kan släppa Fredrik riktigt än. En stjärna över Atlanten visar henne vägen och snart skymtar Frihetsgudinnan mellan molnen ... Detta är den fjärde delen i serien En julstjärna över Atlanten, en erotisk berättelse om att frigöra sig själv från gamla bojor och ge sig ut på okänt vatten. Serien om Charlie Brofjords erotiska äventyr under en nystart i New York som designstudent. Ella Lang är pseudonym för en svensk författare som gärna ger sig in i erotikens värld med sitt skrivande. I hennes uppskattade noveller får läsaren följa karaktärerna på en resa mot sexuell njutning och frigörelse. Med sitt skrivande vill hon utforska nya världar och ta sina läsare med på en kittlande resa in i fantasins gränsland, där det som annars bara finns i tanken blir levande.', 'http://books.google.com/books/content?id=M5VQEAAAQBAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 19, 2021, 'sv', 163, 17, 11, '8728052013', 1706458630, NULL),
(31, 'Fyra fönster mot gården', 'På gården till ett bostadskvarter i Skoga skymmer byggnadsställningar i tur och ordning sikten från tre fönster från vilka man ser in genom ett fjärde, där någonting märkligt pågår. En av dem som riktar blicken mot fönstret är författaren Almi Graan, som alltid är vaken på nätterna. Något som gör henne till ett unikt vittne, men av vad?', 'http://books.google.com/books/content?id=APupDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 170, 2019, 'sv', 104, 17, 157, '9113104136', 1706458630, NULL),
(33, 'Stockholm Sin: En vecka i skärgården', 'Inga och Sven har stämt träff vid biografen och Sven fixar biljetter till platserna längst bak i biografen. Även om det är de mest privata platserna och det känns väldigt skönt när Sven tar på henne är Inga ändå blyg när det finns andra i lokalen. När de en annan dag ses hemma hos Sven är de äntligen ensamma och redo att gå längre. Men Svens föräldrar kommer hem tidigare än beräknat och nu känner de tydligt av frustrationen av att inte få vara med varandra, så Sven bokar en stuga i skärgården där de kan vara ensamma en hel vecka. Ella Lang är pseudonym för en svensk författare som gärna ger sig in i erotikens värld med sitt skrivande. I hennes uppskattade noveller får läsaren följa karaktärerna på en resa mot sexuell njutning och frigörelse. Med sitt skrivande vill hon utforska nya världar och ta sina läsare med på en kittlande resa in i fantasins gränsland, där det som annars bara finns i tanken blir levande.', 'http://books.google.com/books/content?id=lXEpEAAAQBAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api', 30, 2021, 'sv', 163, 17, 11, '8726840588', 1706458630, NULL),
(34, 'Handbook Integrated Care', 'This handbook gives profound insight into the main ideas and concepts of integrated care. It offers a managed care perspective with a focus on patient orientation, efficiency, and quality by applying widely recognized management approaches to the field of health care. The handbook also provides international best practices and shows how integrated care does work throughout various health systems. The delivery of health and social care is characterised by fragmentation and complexity in most health systems throughout the world. Therefore, much of the recent international discussion in the field of health policy and health management has focused on the topic of integrated care. “Integrated” acknowledges the complexity of patients ́ needs and aims to meet it by taking into account both health and social care aspects. Changing and improving processes in a coordinated way is at the heart of this approach.', 'http://books.google.com/books/content?id=WFsqDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 595, 2017, 'en', 166, 33, 1186, '3319561030', 1706458630, NULL),
(35, 'Gratislunchen', 'De senaste århundrandena har vi kunnat avnjuta historiens största gratislunch. Det fossila bränslet har gett oss en frihet som människan tidigare bara kunnat drömma om. Men: Oljereserverna minskar utan möjlighet till påfyllning, samtidigt som vårt beroende av de sinande resurserna bara ökar. Att säga att det inte bådar gott är en underdrift. Det här är en bok om oljan och dess ändlighet. Den innehåller siffror, diagram och matematiska kurvor -- men försöker också att ge ett sammanhang. Därför börjar den med upplysningens filosofi och romantikens poesi för att via den franska konstscenen under sent 1800-tal nå fram till idag: En civilisation vars kärna är att förvandla allt större mängder oersättliga naturresurser till sopor', 'http://books.google.com/books/content?id=xVMGCwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 300, 2016, 'sv', 122, 9, 110, '9100138711', 1706458630, 1706705797),
(36, 'The myths of the New World', NULL, 'http://books.google.com/books/content?id=DiD4Pjg5iNUC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 331, 1868, 'en', 179, 32, 106, '1465554556', 1706458630, NULL),
(37, 'Kvinnosaker', 'Kvinnosaker berättar svenska kvinnors historia genom femtio föremål, från sekelskiftet 1900 fram till idag. Historikern Karin Carlsson skriver på ett fängslande och underhållande sätt om tingen som påverkat kvinnors vardag och format förutsättningarna för ett mer självständigt liv. Men vad som betraktats som frigörande och positivt under en specifik period kan i en annan tid ses som förtryckande och inskränkande, föremålen bär på så vis på berättelser om samhällsförändring och normförskjutning. Läs om den provocerande cykeln, vibratorn som botade tuberkulos, byxkjolen för kvinnliga poliser, Ester Blenda Nordströms cigarett och mycket mer – allt livfullt illustrerat av Amanda Berglund. Boken ges ut i samarbete med Stockholm Kvinnohistoriska.', 'http://books.google.com/books/content?id=tDHpDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 323, 2020, 'svenska', 117, 24, 110, '9178871077', 1706458630, 1706705319),
(38, 'Vår sång blir stum', 'På Skoga stadshotell är det bankett med anledning av ett studentexamensfirande. Sången om studentens lyckliga dag stiger mot taket i hotellets festvåning, men när Puck Bure går upp på rummet för att ta en paus från festligheterna möts hon av en ohygglig syn ...', 'http://books.google.com/books/content?id=vYqsDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 159, 2019, 'sv', 104, 17, 157, '9113104004', 1706458630, NULL),
(39, 'Designing for Learning in a Networked World', 'Designing for Learning in a Networked World provides answers to the following questions: what skills are required for living in a networked world; how can educators design for learning these skills and what role can and should networked learning play in a networked world? It discusses central theoretical concepts and draws on current debates about competences necessary to thrive in contemporary society. The book presents detailed analyses of skills needed and investigates the question of how one can design for learning in specific empirical cases, ranging in academic level from preschool to university teaching. The book clarifies the different conceptions of design within the educational field and offers a framework for thinking critically about instances of networked learning. It analyses digital and Computational Literacy and discusses participatory skills for learning in a networked world. Examples of specific empirical cases include teaching programming to students not necessarily intrinsically motivated to learn; facilitation of a participatory public in the library and designs for children’s transition from day-care to primary school, discussed as a matter of networked contexts. Engaging thoughtfully with the question of ‘21st century skills’, this book will be vital reading to scholars, researchers and students within the fields of education, networked learning, learning technology and the learning sciences, digital literacy, design for learning, and library studies.', 'http://books.google.com/books/content?id=omJODwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 304, 2018, 'en', 184, 28, 492, '1351232339', 1706458630, NULL),
(40, 'Fäst vid dig / En vintersaga', 'Fäst vid dig Volontären Aspyn vill egentligen hellre väcka medvetenhet kring naturfrågor än att själv bli medveten om de stenhårda musklerna under politikerhöjdaren Bradys dyra kostym ... Över en natt har hon blivit en del av familjen Marshalls strategi för att vinna valet – och allt hon kan göra är att hoppas att dansen med djävulen ska betyda förändring för hennes hjärtefrågor. Fast när djävulen är supersexige Brady vill Aspyn snart göra mycket mer än bara dansa! En vintersaga Raoul vill inte erkänna det ens för sig själv, men hans hjärta klappar starkt för skidässet Crystal – hans brors änka och strängt förbjuden mark! Så när de tillbringar julen tillsammans med hans familj i Chamonix måste han kämpa hårt för att inte avslöja sina känslor. Men trots att utflykter och familjekvällar snart blir till rena tortyren vet han ändå inte hur han ska stå ut när hon inom kort åker hem till Colorado igen ...', 'http://books.google.com/books/content?id=5VNPBQAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 263, 2013, 'sv', 128, 17, 69, '9150707825', 1706458630, NULL),
(41, 'Pas på, Katja', '&#34;Hvor i himlens navn var de henne? Hvad i alverden havde fået dem til at gå deres vej netop nu, da hun endelig var kommet? Og hvorfor – hvorfor havde de i det mindste ikke lagt en seddel med en besked til hende på bordet i entreen eller på køkkenbordet eller et andet sted, hvor hun ikke kunne undgå at finde den?&#34; 16-årige Katja har endelig fået sommerferie og er kommet helt fra Stockholm for at holde ferie hos sin farmor og farfar. Da hun når frem, står farfar der for første gang ikke klar til at hente hende. Katja fornemmer straks, at der må være sket noget, for farfar er der altid til at hente, og farmor er altid klar med mad til hende derhjemme. På bussen ud til farmor og farfars hus har Katja mødt Jan på fem år og hans søde mor. Det bliver hendes redning, mens hun forsøger at finde ud af, hvad der er sket med hendes bedsteforældre, og hvordan hun skal klare sig gennem sommeren uden dem. Bogen udkom første gang i 1972 og henvender sig til unge fra 12 år og opefter. Den er første del af den spændende serie om Katja og Jan og deres mange eventyr. Den svenske forfatter Dagmar Maria Lange (1914-1991) skrev en lang række krimier under pseudonymet Maria Lang. Efter sin debut i 1949 med krimien &#34;Morderen lyver&#34; udgav Maria Lang én krimi om året og bliver i dag betragtet som Sveriges første krimidronning. Maria Lang havde en doktorgrad i litteratur og ved siden af virket som krimiforfatter skrev hun filmmanuskripter og skuespil samt avisartikler om blandt andet opera.', 'http://books.google.com/books/content?id=KN2dEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 127, 2022, 'da', 104, 29, 157, '872845202X', 1706458630, NULL),
(42, 'Dubbelsäng i Danmark', 'På en tillställning i Köpenhamn, dit Camilla Martin-Wijk just anlänt för att göra ett gästspel på Kungliga teatern, sticker en viss Preben Felding till henne en lapp med en adress på. Trots att hon inte borde - hon är ju gift - tar hon en taxi dit. Men när hon kryper ner i dubbelsängen är det inte Preben som ligger där. Det är en död kvinna.', 'http://books.google.com/books/content?id=5PqpDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 165, 2019, 'sv', 104, 17, 157, '9113103938', 1706458630, NULL),
(43, 'Vitklädd med ljus i hår', 'Natten till den 13 december står hon plötsligt på tröskeln - en Lucia som varken husets fru eller herre har sett förut. Yrvakna tar de emot vad hon bjuder dem från sin kaffebricka. De dricker. Hon försvinner. En okänd överbringerska av plågor och död, snart uppslukad i vimlet på de mörka storstadsgatorna ...', 'http://books.google.com/books/content?id=zYqsDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 153, 2019, 'sv', 104, 17, 157, '9113104071', 1706458630, NULL),
(44, 'Körsbär i november', 'När Christer Wijk lockas att försöka lösa mordgåtan med de förgiftade körsbären har det sånär som på några dagar gått tjugofem år sedan brottet begicks. Ett problem med detta är att Skoga har förändrats så mycket, ett annat att när tjugofem år väl har gått, kan mördaren inte längre ställas till svars. Det blir en kamp mot klockan ...', 'http://books.google.com/books/content?id=p4qsDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 172, 2019, 'sv', 104, 17, 157, '9113103857', 1706458630, NULL),
(45, 'Gullregn i oktober', 'Efter att en anonym ortsbo vunnit en miljon kronor på Lotto börjar det skvallras rejält runt om i Skoga, där det denna oktober aldrig tycks sluta regna. Så en natt hittas en man död i närheten av kyrkogården och Christer Wijk gör ett besynnerligt fynd bredvid kroppen. Och medan ryktena jagar varann genom småstaden tätnar mysteriet.', 'http://books.google.com/books/content?id=-vqpDwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 166, 2019, 'sv', 104, 17, 157, '9113104128', 1706458630, NULL),
(46, 'Låt hjärtat visa vägen / En sista natt / I hetaste laget', 'Låt hjärtat visa vägen Romeo Brunetti har uppnått affärsmässiga framgångar genom att konsekvent stänga av sina känslor. Förutom den gången då han i ett ögonblick av dumdristighet förlorade sig i den vackra Maisie O’Connell. Nu har hans förflutna hunnit ikapp – och med det en fyraårig son. Romeo inser att om han någon gång ska följa sitt hjärta så är det nu! Men Maisie verkar inte lika övertygad ... En sista natt Som kronprins har Maksim fått lära sig att plikten kommer först och att kärlek bara skapar problem. Nu behöver hans kungarike en arvinge och när Maksim upptäcker att hans älskarinna inte kan få barn måste han göra slut. Men först vill han ha en sista passionerad natt i hennes varma säng ... I hetaste laget Lorelei LaBlanc försöker minnas vad som egentligen hände kvällen innan systerns bröllop. Alltför mycket champagne. En passionerad natt med Donovan St. James. Det kan inte vara sant, hon får absolut inte kopplas ihop med stans hetaste journalist! Lorelei har ju ett viktigt jobb att sköta.', 'http://books.google.com/books/content?id=dSlJEAAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api', 399, 2021, 'sv', 124, 17, 79, '9150768883', 1706458631, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created`, `modified`) VALUES
(9, 'Deckare', 1706458616, 1706556126),
(13, 'Religion', 1706458616, NULL),
(17, 'Fiction', 1706458616, NULL),
(19, 'IT & Data', 1706458616, NULL),
(22, 'Drama', 1706458616, NULL),
(24, 'Historia', 1706458616, NULL),
(28, 'Utbildning', 1706458616, NULL),
(29, 'Juvenile Fiction', 1706458616, NULL),
(32, 'Folklore', 1706458616, 1706706141),
(33, 'Medicin', 1706458616, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `bookId`, `amount`) VALUES
(15, 24, 42, 1),
(16, 24, 41, 1),
(17, 24, 40, 1),
(18, 24, 39, 1),
(19, 25, 43, 1),
(20, 25, 45, 1),
(21, 25, 39, 1),
(22, 25, 35, 1),
(23, 25, 34, 1),
(24, 26, 22, 1),
(25, 26, 21, 1),
(26, 27, 24, 1),
(27, 27, 16, 1),
(28, 27, 15, 1),
(29, 27, 26, 1),
(30, 28, 19, 1),
(31, 28, 20, 1),
(32, 28, 15, 1),
(33, 29, 23, 1),
(34, 29, 22, 1),
(35, 29, 24, 1),
(36, 29, 27, 1),
(37, 30, 26, 1),
(38, 30, 25, 1),
(39, 30, 28, 1),
(40, 30, 33, 1),
(41, 30, 31, 1),
(42, 30, 29, 1),
(43, 31, 15, 1),
(44, 31, 22, 1),
(45, 31, 21, 1),
(46, 31, 24, 1),
(47, 32, 27, 4),
(48, 32, 26, 6),
(49, 32, 25, 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderDate` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `shipmentId` int(11) NOT NULL,
  `orderStatus` varchar(20) NOT NULL,
  `Modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderDate`, `totalPrice`, `shipmentId`, `orderStatus`, `Modified`) VALUES
(24, 1706462443, 914, 32, 'processing', 1706563602),
(25, 1706463825, 2141, 35, 'new', NULL),
(26, 1706781139, 2676, 46, 'new', NULL),
(27, 1706781770, 1337, 47, 'new', NULL),
(28, 1706782307, 1655, 48, 'new', NULL),
(29, 1706782530, 4019, 49, 'new', NULL),
(30, 1706782705, 1509, 50, 'new', NULL),
(31, 1706783026, 3224, 51, 'new', NULL),
(32, 1706785541, 6389, 52, 'new', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `paymentdate` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `transactionId` int(11) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipCode` varchar(5) NOT NULL,
  `city` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `firstName`, `lastName`, `address`, `zipCode`, `city`, `mobile`, `email`, `created`, `modified`) VALUES
(30, 'Anstasia', 'Khitsjo', 'Vilkengata 1', '14250', 'Skogås', '54979794', 'a@test.se', 1706460992, NULL),
(31, 'Anstasia', 'Khitsjo', 'Vilkengata 1', '14250', 'Skogås', '54979794', 'a@test.se', 1706461083, NULL),
(32, 'Anstasia', 'Khitsjo', 'Vilkengata 1', '14250', 'Skogås', '54979794', 'a@test.se', 1706462443, NULL),
(33, 'Anstasia', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '726564865', 'test@test.se', 1706463521, NULL),
(34, 'Anstasia', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '726564865', 'test@test.se', 1706463638, NULL),
(35, 'Anstasia', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '726564865', 'test@test.se', 1706463825, NULL),
(36, 'Anstasia', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '726564865', 'test@test.se', 1706463933, NULL),
(38, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0720805487', 'test@test.se', 1706621066, NULL),
(39, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0720805487', 'test@test.se', 1706621207, NULL),
(40, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0700806594', 'test@test.se', 1706621270, NULL),
(41, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0700806594', 'test@test.se', 1706621392, NULL),
(42, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0700806594', 'test@test.se', 1706621444, NULL),
(43, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0700806594', 'test@test.se', 1706621775, NULL),
(44, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0700806594', 'test@test.se', 1706623030, NULL),
(45, 'testname', 'testname', 'testgata', '12359', 'Farsta', '0700806594', 'test@test.se', 1706624254, NULL),
(46, 'Frej', 'Voronins', 'Russingatan 1', '12359', 'Farsta', '0725806589', 'f@v.se', 1706781136, NULL),
(47, 'Eliah', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '0725098747', 'e@v.se', 1706781768, NULL),
(48, 'Eliah', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '0725098747', 'e@v.se', 1706782305, NULL),
(49, 'Eliah', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '0725098747', 'e@v.se', 1706782528, NULL),
(50, 'Eliah', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '0725098747', 'e@v.se', 1706782703, NULL),
(51, 'Eliah', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '0725098747', 'e@v.se', 1706783024, NULL),
(52, 'Eliah', 'Voronins', 'Russinvägen 1', '12359', 'Farsta', '0725098747', 'e@v.se', 1706785539, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userorderitems`
--

CREATE TABLE `userorderitems` (
  `id` int(11) NOT NULL,
  `userOrderId` int(11) NOT NULL,
  `bookId` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userorderitems`
--

INSERT INTO `userorderitems` (`id`, `userOrderId`, `bookId`, `amount`) VALUES
(14, 9, 18, 1),
(15, 9, 37, 1),
(16, 9, 35, 1),
(17, 9, 33, 1),
(18, 9, 29, 1),
(19, 9, 43, 1),
(20, 10, 16, 2),
(21, 10, 43, 15),
(22, 10, 41, 2),
(24, 12, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `userorders`
--

CREATE TABLE `userorders` (
  `id` int(11) NOT NULL,
  `orderDate` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `shipmentId` int(11) NOT NULL,
  `orderStatus` varchar(20) NOT NULL,
  `Modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userorders`
--

INSERT INTO `userorders` (`id`, `orderDate`, `totalPrice`, `userId`, `shipmentId`, `orderStatus`, `Modified`) VALUES
(9, 1706463933, 741, 3, 36, 'new', NULL),
(10, 1706621777, 3022, 3, 43, 'completed', 1706706863),
(12, 1706624255, 353, 3, 45, 'new', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `accountLevel` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zipCode` varchar(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `mobile` varchar(13) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `accountLevel`, `password`, `address`, `zipCode`, `city`, `mobile`, `email`, `created`, `modified`) VALUES
(1, 'Sergejs', 'Voronins', 'admin', '$2y$10$1QH0fL.4ASJtYJS29NHfk.7WTY3yVmn7NAYCvaF.BtZDITgUF5a5m', 'Russinvägen 1', '12359', 'Farsta', '0720801071', 'sergejs.voronins@medieinstitutet.se', 1703588794, NULL),
(3, 'Anders', 'Andersson', 'user', '$2y$10$CgfBcgUsHfEWXIFd5Tvea.FyGJVntnG1W8UO0JO3q8yQaTv0ZuNu2', 'Andersgatan 1', '14250', 'Skogås', '0720205497', 'test@test.se', 1705588715, 1706721200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`authorId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderItemsBooks` (`bookId`),
  ADD KEY `orderItemsOrders` (`orderId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment` (`shipmentId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentsOrders` (`orderId`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userorderitems`
--
ALTER TABLE `userorderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userOrderId` (`userOrderId`);

--
-- Indexes for table `userorders`
--
ALTER TABLE `userorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipmentId` (`shipmentId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `userorderitems`
--
ALTER TABLE `userorderitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `userorders`
--
ALTER TABLE `userorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `author` FOREIGN KEY (`authorId`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `categoryId` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderItemsBooks` FOREIGN KEY (`bookId`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `orderItemsOrders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `shipment` FOREIGN KEY (`shipmentId`) REFERENCES `shipments` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `paymentsOrders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `userorderitems`
--
ALTER TABLE `userorderitems`
  ADD CONSTRAINT `userOrderId` FOREIGN KEY (`userOrderId`) REFERENCES `userorders` (`id`);

--
-- Constraints for table `userorders`
--
ALTER TABLE `userorders`
  ADD CONSTRAINT `shipmentId` FOREIGN KEY (`shipmentId`) REFERENCES `shipments` (`id`),
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
