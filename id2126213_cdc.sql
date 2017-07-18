-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2017 at 11:14 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id2126213_cdc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_messages`
--

CREATE TABLE `admin_messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `msg_content` longtext NOT NULL,
  `unread` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_messages`
--

INSERT INTO `admin_messages` (`id`, `sender_id`, `sender_name`, `sender_email`, `topic`, `msg_content`, `unread`, `timestamp`) VALUES
(1, 1, 'NOM Administrateur', 'admin@admin', 'Bonjour le Club', 'Cat ipsum dolor sit amet, curl into a furry donut stare at ceiling yet dream about hunting birds for poop in a handbag. Look delicious and drink the soapy mopping up water then puke giant foamy fur-balls.<br />\r\nStares at human while pushing stuff off a table jump launch to pounce upon little yarn mouse, bare fangs at toy run hide in litter box until treats are fed.', 0, '2017-07-02 13:57:42'),
(2, 3, 'utilisatrice', 'email02@email', 'Mister Booby Buyer', 'I am Mr. Booby Buyer. I\'ll buy those boobies for 25 schmeckles! Rick, I don\'t like glowing rocks in the kitchen trash! My man! God, Grandpa, you\'re such a dick.<br />\r\nAww, gee, you got me there, Rick. Isn\'t it obvious Morty? I froze him. We all wanna die, we\'re meeseeks! There is no god, Summer; gotta rip that band-aid off now you\'ll thank me later.', 0, '2017-07-02 14:40:23'),
(3, 3, 'Francisco Franklin', 'francisco.franklin57@example.com', 'Objet du mail', 'lkdhsrwldkfswhx', 0, '2017-07-11 17:10:23'),
(4, 0, 'juju', 'odejrd@gmail.com', 'just to tell u ur siteweb is Swag', 'a very swag web site i like 20/10 wld recommend <br />\r\ncongratz', 0, '2017-07-12 12:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'autobiographie'),
(2, 'antiquité'),
(3, 'santé'),
(4, 'science-fiction'),
(5, 'polar'),
(6, 'jeunesse'),
(7, 'romance'),
(8, 'action'),
(9, 'horreur'),
(10, 'fantastique');

-- --------------------------------------------------------

--
-- Table structure for table `chatbox`
--

CREATE TABLE `chatbox` (
  `id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `messages` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatbox`
--

INSERT INTO `chatbox` (`id`, `salon_id`, `user_id`, `messages`, `timestamp`) VALUES
(1, 1, 2, 'Hey', '2017-06-12 07:06:29'),
(2, 1, 1, 'Hey!', '2017-06-12 09:06:29'),
(3, 1, 2, 'Pellentesque vel dui sed orci faucibus iaculis. Suspendisse dictum magna id purus tincidunt rutrum. Nulla congue. Vivamus sit amet lorem posuere dui vulputate ornare. Phasellus mattis sollicitudin ligula. Duis dignissim felis et urna. Integer adipiscing congue metus. Nam pede. Etiam non wisi. Sed accumsan dolor ac augue. Pellentesque eget lectus. Aliquam nec dolor nec tellus ornare venenatis. Nullam blandit placerat sem. Curabitur quis ipsum. Mauris nisl tellus, aliquet eu, suscipit eu, ullamcorper quis, magna. Mauris elementum, pede at sodales vestibulum, nulla tortor congue massa, quis pellentesque odio dui id est. Cras faucibus augue.', '2017-06-14 09:06:29'),
(4, 1, 1, 'Nulla dui purus, eleifend vel, consequat non, dictum porta, nulla. Duis ante mi, laoreet ut, commodo eleifend, cursus nec, lorem. Aenean eu est. Etiam imperdiet turpis. Praesent nec augue. Curabitur ligula quam, rutrum id, tempor sed, consequat ac, dui. Vestibulum accumsan eros nec magna. <br />\n<br />\nVestibulum vitae dui. Vestibulum nec ligula et lorem consequat ullamcorper. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Phasellus eget nisl ut elit porta ullamcorper. Maecenas tincidunt velit quis orci. Sed in dui. Nullam ut mauris eu mi mollis luctus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Sed cursus cursus velit. Sed a massa. Duis dignissim euismod quam. Nullam euismod metus ut orci. Vestibulum erat libero, scelerisque et, porttitor et, varius a, leo.', '2017-06-14 15:08:37'),
(5, 1, 2, 'Cras dictum. Maecenas ut turpis. <br />\nIn vitae erat ac orci dignissim eleifend. Nunc quis justo. Sed vel ipsum in purus tincidunt pharetra. <br />\n<br />\nSed pulvinar, felis id consectetuer malesuada, enim nisl mattis elit, a facilisis tortor nibh quis leo. Sed augue lacus, pretium vitae, molestie eget, rhoncus quis, elit.', '2017-06-15 11:06:29'),
(6, 1, 1, 'Nulla dui purus, eleifend vel, consequat non, dictum porta, nulla. Duis ante mi, laoreet ut, commodo eleifend, cursus nec, lorem.', '2017-06-17 09:08:39'),
(7, 1, 2, 'Cras sed ante. Phasellus in massa. Curabitur dolor eros, gravida et, hendrerit ac, cursus non, massa. Aliquam lorem. In hac habitasse platea dictumst. Cras eu mauris. Quisque lacus.', '2017-07-17 14:06:29'),
(8, 1, 1, 'Hello, I\'m writing here to add data for my admin dashboard. Thanks.', '2017-06-18 14:06:29'),
(9, 2, 2, 'Hello world', '2017-06-18 14:17:37'),
(10, 2, 1, 'Alright, let\'s mafia things up a bit. Joey, burn down the ship. Clamps, burn down the crew. <br />\nGuess again. Is today\'s hectic lifestyle making you tense and impatient? I just want to talk. It has nothing to do with mating. Fry, that doesn\'t make sense.', '2017-06-19 14:21:01'),
(11, 2, 3, 'I can explain. It\'s very valuable. Belligerent and numerous. Hey, guess what you\'re accessories to. Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual inhibitions? Oh sure! Blame the wizards!', '2017-06-19 15:21:21'),
(12, 2, 2, 'Calculon is gonna kill us and it\'s all everybody else\'s fault! Alright, let\'s mafia things up a bit. Joey, burn down the ship. Clamps, burn down the crew. Enough about your promiscuous mother, Hermes! We have bigger problems.<br />\n<br />\nYou can crush me but you can\'t crush my spirit!<br />\nTake me to your leader!<br />\nBelligerent and numerous.', '2017-06-20 11:21:38'),
(13, 2, 1, 'She also liked to shut up! Okay, it\'s 500 dollars, you have no choice of carrier, the battery can\'t hold the charge and the reception isn\'t very… Throw her in the brig. I\'ve got to find a way to escape the horrible ravages of youth. Suddenly, I\'m going to the bathroom like clockwork, every three hours. And those jerks at Social Security stopped sending me checks. Now \'I\'\' have to pay \'\'them\'!', '2017-06-20 15:21:50'),
(14, 2, 2, 'I\'m Santa Claus! Large bet on myself in round one.<br />\nAnd until then, I can never die?<br />\nThrow her in the brig. Or a guy who burns down a bar for the insurance money! Guards! Bring me the forms I need to fill out to have her taken away! There\'s no part of that sentence I didn\'t like! Oh God, what have I done?', '2017-08-21 11:22:07'),
(15, 2, 3, 'Say it in Russian! What are their names? I don\'t \'need\' to drink. I can quit anytime I want! Belligerent and numerous.<br />\n<br />\nThese old Doomsday Devices are dangerously unstable. I\'ll rest easier not knowing where they are. Aww, it\'s true. I\'ve been hiding it for so long. Meh. I\'m sorry, guys. I never meant to hurt you. Just to destroy everything you ever believed in.', '2017-06-26 19:22:23'),
(16, 2, 1, 'Stop it, stop it. It\'s fine. I will \'destroy\' you! Well, let\'s just dump it in the sewer and say we delivered it. Fetal stemcells, aren\'t those controversial? I daresay that Fry has discovered the smelliest object in the known universe!<br />\n<br />\nNow, now. Perfectly symmetrical violence never solved anything. And from now on you\'re all named Bender Jr. For the last time, I don\'t like lilacs! Your \'first\' wife was the one who liked lilacs! This opera\'s as lousy as it is brilliant! Your lyrics lack subtlety. You can\'t just have your characters announce how they feel. That makes me feel angry!', '2017-06-27 20:22:57'),
(17, 4, 1, 'Hello Bikki, you here?', '2017-06-28 15:54:17'),
(18, 4, 5, '#JusticeForCredence', '2017-07-18 22:57:02'),
(19, 4, 1, '#GiveErzaAnAward', '2017-07-30 15:55:00'),
(20, 4, 5, '#FreeEddieRedmayne', '2017-07-18 22:57:05'),
(21, 4, 1, 'The only fantastic thing about that movie is the what-the-fuck-ing', '2017-07-02 15:56:14'),
(22, 3, 5, 'Le pire film de la saga', '2017-07-03 12:16:40'),
(23, 2, 3, 'Hey!', '2017-07-18 22:57:08'),
(24, 4, 3, 'Those guys are inside you building a piece of shit Ethan! They\'re inside you building a monument to compromise! Fuck them, fuck those people, fuck this whole thing Ethan. Like nothing shady ever happened in a fully furnished office?', '2017-07-03 13:29:39'),
(25, 4, 4, 'You ever hear about Wall Street Morty? You know what those guys do in their fancy board rooms? They take their balls and dip \'em in cocaine and wipe \'em all over each other. You know Grandpa goes around and he does his business in public because grandpa isn\'t shady.', '2017-07-03 13:30:19'),
(26, 4, 5, 'Yo! What up my glip glops! its fine, everythings is fine. theres an infinite number of realities Morty, and in a few dozens of those i got lucky and turned everything back to normal. I just killed my family! I don’t care who they were! No jumping in the sewer!', '2017-07-03 16:30:49'),
(27, 4, 1, 'I mixed in some praying mantis DNA. You know a praying mantis is the exact opposite of a vole, Morty? They mate once and then bluergh cut each other\'s heads off. God? God\'s turning people into insect monsters Beth. I\'m the one beating them to death. Thank me.', '2017-07-03 17:31:16'),
(28, 4, 4, '\'Quantum carburetor\'? Jesus, Morty. You can\'t just add a Sci-Fi word to a car word and hope it means something... Huh, looks like something\'s wrong with the microverse battery. We\'re gonna have to go inside. Well he roped me into this!', '2017-07-03 19:31:46'),
(29, 4, 3, 'Je ferme ce salon, bonsoir.', '2017-07-03 20:33:07'),
(30, 6, 4, 'Salut !', '2017-07-18 22:56:42'),
(31, 6, 4, 'Bonjour!', '2017-07-03 18:00:04'),
(32, 6, 4, 'Ah ! Mon ami Julian..', '2017-07-18 22:56:46'),
(33, 6, 5, 'Et ton amie Lisa? ;)', '2017-07-03 18:01:51'),
(34, 6, 1, 'Et ton amie admin? :\')', '2017-07-04 20:03:09'),
(35, 6, 4, 'Yay tous ces amis :\')', '2017-07-18 22:56:49'),
(36, 6, 4, 'Du coup, vu le film, tous ces comptes.. Y\'a pas un lien quelque part ?', '2017-07-18 22:56:51'),
(37, 6, 1, 'c\'bon, tu peux fermer le chat je pense! tout le monde a écrit au moins un message', '2017-07-05 16:05:24'),
(38, 6, 1, 'mais attends', '2017-07-06 15:05:38'),
(39, 6, 1, 'nan bouges pas! haha', '2017-07-03 18:05:44'),
(40, 6, 5, 'voilà! normalement c\'est bon', '2017-07-11 23:06:35'),
(41, 6, 4, 'Ahué par contre jpense jamais à scroll, y\'a pas un moyen de faire en sorte que l\'iframe ça scroll tout en bas automatiquement à chaque tour ?', '2017-07-18 22:56:54'),
(42, 6, 5, 'normalement ça le fait tout seul :/', '2017-07-05 21:06:51'),
(43, 6, 5, 'Test test test est-ce que tu scroll', '2017-07-13 22:07:11'),
(44, 6, 5, 'Nan okay ça bug, j\'vais corriger ça lmao', '2017-07-13 21:07:23'),
(45, 6, 4, 'Yes ce serait mieux haha', '2017-07-18 22:56:56'),
(46, 7, 4, 'I can finally go on that trip I\'ve been talking about. Well, she\'s my daughter, Summer. I outrank you. Or, family means nothing, in which case, don\'t play that card. Dont look at me! That guy over there roped me into this. Prepare to be emancipated from your own inferior genes!', '2017-07-09 21:48:08'),
(47, 7, 1, 'Get off the high road Summer. We all got pink eye because you wouldn\'t stop texting on the toilet. Whoa, spoilers! I\'m a whole season behind. We don\'t whitewash it either, Morty. I mean, the pirates are really rapey. He\'s not a hot girl. He can\'t just bail on his life and set up shop in someone else\'s.', '2017-07-12 22:48:26'),
(48, 7, 4, 'You created a day care for my dad? The trick to cereal is keeping 70% of it above the milk. Well, she\'s my daughter, Summer. I outrank you. Or, family means nothing, in which case, don\'t play that card. Oh good job Morty! You killed my best customer but you saved a mind reading fart!', '2017-07-17 20:48:37'),
(49, 7, 2, 'There is no god, Summer; gotta rip that band-aid off now you\'ll thank me later. Get off the high road Summer. We all got pink eye because you wouldn\'t stop texting on the toilet. Awww, it\'s you guys! You\'re our boy dawg, don\'t even trip.', '2017-07-12 08:49:19'),
(50, 7, 1, 'Hi! Principal Vagina: the name\'s real, possibly Scandinavian. I\'m Mr. Crowbar, and here is my friend, who is also a crowbar! If I\'ve learned one thing, it\'s that before you get anywhere in life, you gotta stop listening to yourself. Did you just come into the cafeteria through a portal?', '2017-07-12 08:49:54'),
(51, 7, 5, 'Alien Invasion Tomato Monster Mexican Armada Brothers Who Are Just Regular Brothers Running In A Van From An Asteroid And All Sorts Of Things: The Movie. Hit the sack, Jack! Not MY fault this is happening. You\'re growing up fast, Morty. You\'re going into a great big thorn straight into my ass.', '2017-07-12 09:50:26'),
(52, 7, 4, 'Aw, man! I really liked this life! Well, at least I didn\'t really crap my pants. Yo! What up my glip glops! You know what a vole is, Morty? You know what a vole is? You can run, but you can\'t hide bitch!', '2017-07-21 11:50:37'),
(53, 7, 4, 'I\'m very much in charge. Reminding you that tonight is our annual flu season dance. I don\'t know how many times I have to say this, but if you have the flu, stay home. The flu season dance is about awareness, not celebration. You don\'t bring dead babies to Passover. Pluto\'s a planet. It probably has space aids. Yea. If you spend all day shuffling words around you can make anything sound bad, Morty.', '2017-07-17 10:51:16'),
(54, 7, 1, 'I dunno, some people would pay top dollar for that kind of breakthrough. Oh no. I\'m late to class, bitch. Morty, can you get to the left nipple? Nice one, Ms Pancakes.', '2017-07-14 17:53:59'),
(55, 7, 2, 'Burgertime! I\'d like to order one large person with extra people please. white people, no no no black people... and hispanic on half. It\'s like the N word and the C word had a baby, and it was raised by all the bad words for Jews.', '2017-07-21 16:54:41'),
(56, 7, 4, 'Fermeture du salon', '2017-07-14 20:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `custom_items`
--

CREATE TABLE `custom_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `is_footer_link` int(11) NOT NULL,
  `is_draft` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `custom_items`
--

INSERT INTO `custom_items` (`id`, `name`, `content`, `is_footer_link`, `is_draft`) VALUES
(1, 'Conditions générales d\'utilisation', '&lt;h2&gt;Conditions&lt;/h2&gt;&lt;br&gt;\n&lt;p&gt;Aliquam aliquet, est a ullamcorper condimen&lt;i&gt;tum, tellus nulla fringilla elit, a iaculis nulla turpis sed wisi. Fusce volutpat. Etiam sodales ante id nunc. Proin ornare dignissim lacus. Nunc porttitor nunc a sem. Sed sollicitudin velit eu magna&lt;/i&gt;&lt;/p&gt;&lt;br&gt;\n&lt;p&gt;&lt;font size=&quot;5&quot;&gt;Aliquam erat volutpat. Vivamus ornare est non wisi. Proin vel quam. Vivamus egestas. Nunc tempor diam vehicula mauris. Nullam sapien eros, facilisis vel, eleifend non, auctor dapibus, pede.&lt;/font&gt;&lt;/p&gt;', 1, 0),
(2, 'Politique de confidentialité', '&lt;p&gt;Aliquam aliquet, est a ullamcorper condimentum, tellus nulla fringilla elit, a iaculis nulla turpis sed wisi. Fusce volutpat. Etiam sodales ante id nunc. Proin ornare dignissim lacus. Nunc porttitor nunc a sem. Sed sollicitudin velit eu magna. Aliquam erat volutpat. Vivamus ornare est non wisi. Proin vel quam. Vivamus egestas. Nunc tempor diam vehicula mauris. Nullam sapien eros, facilisis vel, eleifend non, auctor dapibus, pede.&lt;/p&gt;<br />\r\n&lt;h3&gt;hello world&lt;/h3&gt;<br />\r\n&lt;p&gt;Aliquam aliquet, est a ullamcorper condimentum, tellus nulla fringilla elit, a iaculis nulla turpis sed wisi. Fusce volutpat. Etiam sodales ante id nunc. Proin ornare dignissim lacus. Nunc porttitor nunc a sem. Sed sollicitudin velit eu magna. Aliquam erat volutpat. Vivamus ornare est non wisi. Proin vel quam. Vivamus egestas. Nunc tempor diam vehicula mauris. Nullam sapien eros, facilisis vel, eleifend non, auctor dapibus, pede.&lt;/p&gt;', 1, 0),
(3, 'Liens footer', '&lt;ul&gt;\r\n   &lt;li&gt;&lt;!-- facebook --&gt;&lt;a href=&quot;http://facebook.com/&quot; target=&quot;_blank&quot; class=&quot;icon-facebook-alt&quot;&gt;&lt;/a&gt;&lt;/li&gt;\r\n   &lt;li&gt;&lt;!-- twitter --&gt;&lt;a href=&quot;http://twitter.com/&quot; target=&quot;_blank&quot;  class=&quot;icon-twitter&quot;&gt;&lt;/a&gt;&lt;/li&gt;\r\n   &lt;li&gt;&lt;!-- google + --&gt;&lt;a href=&quot;http://google.com/&quot;  target=&quot;_blank&quot; class=&quot;icon-google-plus&quot;&gt;&lt;/a&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0),
(4, 'Adresse footer', '&lt;p&gt;\n  3 rue du Gros Caillou, 75005 Paris&lt;br&gt;\n  +33 923129034&lt;br&gt;\n  bonjour@clubcritique.tk&lt;/p&gt;', 0, 0),
(5, 'Notre concept', '&lt;p&gt;&lt;b&gt;Cras dictum. &lt;/b&gt;Maecenas ut turpis. In vitae erat ac orci dignissim eleifend. Nunc quis justo. Sed vel ipsum in purus tincidunt pharetra. Sed pulvinar, felis id consectetuer malesuada, enim nisl mattis elit, a facilisis tortor nibh quis leo.&lt;/p&gt;\n&lt;p&gt;&lt;ul&gt;&lt;li&gt;Sed augue lacus, pretium vitae, molestie eget, rhoncus quis, elit. Donec in augue. Fusce orci wisi, ornare id, mollis vel, lacinia vel, massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.&lt;br&gt;&lt;/li&gt;&lt;/ul&gt;&lt;/p&gt;\n&lt;p&gt;&lt;a href=&quot;http://google.com/&quot;&gt;Duis eros mi&lt;/a&gt;, dictum vel, fringilla sit amet, fermentum id, sem. Phasellus nunc enim, faucibus ut, laoreet in, consequat id, metus. Vivamus dignissim. Cras lobortis tempor velit. Phasellus nec diam ac nisl lacinia tristique. Nullam nec metus id mi dictum dignissim. Nullam quis wisi non sem lobortis condimentum. Phasellus pulvinar, nulla non aliquam eleifend, tortor wisi scelerisque felis, in sollicitudin arcu ante lacinia leo.&lt;/p&gt;\n&lt;p&gt;Sed pulvinar, felis id consectetuer malesuada, enim nisl mattis elit, a facilisis tortor nibh quis leo. Sed augue lacus, pretium vitae, molestie eget, rhoncus quis, elit. Donec in augue. Fusce orci wisi, ornare id, mollis vel, lacinia vel, massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.&lt;/p&gt;\n&lt;p&gt;Suspendisse vestibulum dignissim quam. Integer vel augue. Phasellus nulla purus, interdum ac, venenatis non, varius rutrum, leo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis a eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce magna mi, porttitor quis, convallis eget, sodales ac, urna. Phasellus luctus venenatis magna. Vivamus eget lacus. Nunc tincidunt convallis tortor.&lt;/p&gt;', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `exchanges`
--

CREATE TABLE `exchanges` (
  `ex_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exchanges`
--

INSERT INTO `exchanges` (`ex_id`, `user_id`, `work_id`, `status`) VALUES
(1, 1, 11, 0),
(2, 1, 2, 0),
(3, 1, 12, 2),
(4, 2, 12, 0),
(5, 2, 7, 0),
(6, 2, 3, 0),
(7, 2, 1, 0),
(8, 2, 5, 2),
(9, 2, 4, 2),
(10, 2, 11, 2),
(11, 3, 6, 0),
(12, 3, 9, 0),
(13, 3, 13, 0),
(14, 3, 15, 0),
(15, 3, 14, 1),
(16, 3, 8, 1),
(17, 3, 3, 1),
(18, 2, 9, 1),
(19, 1, 5, 1),
(20, 1, 8, 1),
(21, 1, 9, 1),
(22, 1, 15, 1),
(23, 1, 14, 1),
(24, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_1_id` int(11) NOT NULL,
  `user_2_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_1_id`, `user_2_id`, `timestamp`) VALUES
(1, 2, 1, '2017-07-02 14:28:50'),
(2, 3, 2, '2017-07-02 14:36:16'),
(3, 1, 2, '2017-07-02 14:37:37'),
(4, 1, 3, '2017-07-02 14:39:02'),
(5, 1, 7, '2017-07-02 15:49:39'),
(6, 5, 1, '2017-07-03 18:08:39'),
(8, 3, 1, '2017-07-11 18:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `grade_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `salon_id`, `grade`, `grade_user`) VALUES
(1, 1, 1, 3, 0),
(2, 2, 1, 1, 0),
(3, 1, 2, 2, 4),
(4, 3, 2, 1, 0),
(5, 3, 2, 4, 2),
(6, 4, 3, 2, 3),
(7, 1, 4, 1, 4),
(8, 3, 4, 1, 4),
(9, 2, 3, 3, 0),
(10, 3, 3, 2, 2),
(11, 5, 3, 1, 1),
(12, 3, 4, 4, 0),
(13, 4, 4, 2, 1),
(14, 5, 4, 4, 1),
(15, 1, 6, 2, 1),
(16, 8, 6, 3, 0),
(17, 5, 6, 4, 3),
(18, 4, 6, 3, 4),
(19, 4, 3, 1, 0),
(20, 1, 7, 1, 4),
(21, 4, 7, 4, 0),
(22, 2, 7, 2, 2),
(23, 5, 7, 3, 3),
(24, 1, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE `private_messages` (
  `id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `msg_content` longtext NOT NULL,
  `unread` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `receiver_id`, `sender_id`, `sender_name`, `sender_email`, `msg_content`, `unread`, `timestamp`) VALUES
(1, 1, 2, 'utilisateur', 'email@email', 'Bonjour,<br />\r\nAre you hungry for apples? We don\'t whitewash it either, Morty. I mean, the pirates are really rapey. Pluto\'s a planet. Meeseeks were not born into this world fumbling for meaning, Jerry!<br />\r\nEw, Grandpa, so gross! You\'re talking about my mom! Hi! I\'m Mr Meeseeks! Look at me! S-S-Samantha. Your failures are your own, old man! I say, follow throooough!', 0, '2017-07-02 14:29:23'),
(2, 2, 1, 'administrateur', 'admin@admin', 'Hello,<br />\r\n<br />\r\nThey\'ll just fall right out of my ass! I\'ve done this too many times! Why don\'t you ask the smartest people in the universe, Jerry? Oh yeah you can\'t. They blew up. Oh, it gets darker, Morty. Welcome to the darkest year of our adventures. First thing that\'s different? No more dad, Morty. Sometimes science is a lot more art, than science. A lot of people don\'t get that.<br />\r\n<br />\r\nI know you\'re real because i have a ton of bad memories with you. Whoa, spoilers! I\'m a whole season behind. Countries known for their sexually aggressive men. I\'m Scary Terry!!', 0, '2017-07-02 14:36:52'),
(3, 3, 1, 'administrateur', 'admin@admin', 'Hello,<br />\r\nI just wanna die! Pluto\'s a planet. What are you looking at, mother fucker! Meeseeks were not born into this world fumbling for meaning, Jerry!<br />\r\nYou know my name, that\'s disarming. This is Principal Vagina. No relation. Morty! The principal and I have discussed it, a-a-and we\'re both insecure enough to agree to a three-way! That\'s Right Morty! This is gonna be a lot like that. Except you know. It\'s gonna make sense.', 0, '2017-07-02 14:39:03'),
(7, 3, 1, 'administrateur', 'admin@admin', '\'; $this-&gt;db-&gt;exec(&quot;SELECT * FROM users&quot;)', 0, '2017-07-11 20:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `salons`
--

CREATE TABLE `salons` (
  `id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL,
  `date` datetime(6) NOT NULL,
  `nbr_person_max` int(11) NOT NULL,
  `admin_salon_id` int(11) NOT NULL,
  `work_isdeleted` int(11) NOT NULL,
  `running` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salons`
--

INSERT INTO `salons` (`id`, `work_id`, `date`, `nbr_person_max`, `admin_salon_id`, `work_isdeleted`, `running`) VALUES
(1, 15, '2017-06-20 20:30:00.000000', 20, 1, 0, 0),
(2, 2, '2017-07-02 20:30:00.000000', 20, 4, 0, 0),
(3, 11, '2017-07-10 22:30:00.000000', 20, 4, 0, 0),
(4, 13, '2017-07-03 15:30:00.000000', 20, 3, 0, 0),
(5, 9, '2017-07-27 22:10:00.000000', 20, 1, 0, 0),
(6, 12, '2017-07-03 18:00:00.000000', 20, 3, 0, 0),
(7, 14, '2017-07-03 17:30:00.000000', 20, 4, 0, 0),
(8, 19, '2017-07-16 20:30:00.000000', 20, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'livre'),
(2, 'film');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT 'utilisateur',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL DEFAULT '/view/assets/img/no-preview.png',
  `isAdmin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `description`, `picture`, `isAdmin`) VALUES
(1, 'admin', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3', '', '/view/assets/img/user_upload/administrateur_595a99efea6cc.jpg', 1),
(2, 'Francis Stewart', 'francis.stewart22@example.com', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '', '/view/assets/img/user_upload/Francis Stewart_596e93e9ae2a4.jpeg', 0),
(3, 'barry.wheeler44', 'barry.wheeler44@example.com', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '', '/view/assets/img/user_upload/barry.wheeler44_596e944c72f20.jpg', 0),
(4, 'krin.edwards92', 'krin.edwards92@example.com', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '', '/view/assets/img/user_upload/krin.edwards92_596e948d44a33.jpg', 0),
(5, 'lillian.payne40', 'lillian.payne40@example.com', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '', '/view/assets/img/user_upload/lillian.payne40_596e94c86c798.jpg', 0),
(6, 'julio.andrews49', 'julio.andrews49@example.com', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '', '/view/assets/img/user_upload/julio.andrews49_596e957855d03.jpg', 0),
(7, 'herminia.medina90', 'herminia.medina90@example.com', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', '', '/view/assets/img/user_upload/herminia.medina90_596e95ab7b3f7.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `img_src` varchar(255) NOT NULL DEFAULT '/view/assets/img/no-preview.png',
  `description` mediumtext NOT NULL,
  `url_amazon` varchar(255) NOT NULL,
  `published_date` date NOT NULL,
  `spotlight` int(11) NOT NULL DEFAULT '0',
  `salon_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `type_id`, `category_id`, `name`, `author`, `img_src`, `description`, `url_amazon`, `published_date`, `spotlight`, `salon_id`, `is_deleted`) VALUES
(1, '1', '1', 'Une vie', 'Simone Veil', '/view/assets/img/works/1_1_595a5f58b9bc1.jpg', 'Simone Veil accepte de se raconter à la première personne. Personnage au destin exceptionnel, elle est la femme politique dont la légitimité est la moins contestée, en France et à l\'étranger ; son autobiographie est attendue depuis longtemps. Elle s\'y montre telle qu\'elle est : libre, véhémente, sereine.', 'https://www.amazon.fr/Une-vie-Simone-Veil/dp/2253127760/ref=zg_bs_books_1?_encoding=UTF8&amp;psc=1&amp;refRID=KV8KCXE7X90D9SH2SVAQ', '0000-00-00', 1, 0, 0),
(2, '1', '2', 'L\'Odyssée', 'Homère', '/view/assets/img/works/1_2_595a5f50ba02c.jpg', 'Faut-il présenter ce &quot; très vieux poème &quot; ? La superbe traduction de Philippe Jaccottet fait revivre l\'épopée d\'Homère qui vient &quot; à son lecteur ou, mieux peut-être, à son auditeur un peu comme viennent à la rencontre du voyageur ces statues ou ces colonnes lumineuses dans l\'air cristallin de la Grèce... &quot;', 'https://www.amazon.fr/LOdyss%C3%A9e-Prepas-scientifiques-2017-2018-prescrite/dp/2707194395/ref=zg_bs_books_2?_encoding=UTF8&amp;psc=1&amp;refRID=KV8KCXE7X90D9SH2SVAQ', '0000-00-00', 1, 0, 0),
(3, '1', '3', 'La Vie secrète des arbres', 'Peter Wohlleben', '/view/assets/img/works/1_3_595a5f47b7103.jpg', 'Les citadins regardent les arbres comme des &quot;robots biologiques&quot; conçus pour produire de l\'oxygène et du bois. Forestier, Peter Wohlleben a ravi ses lecteurs avec des informations attestées par les biologistes depuis des années, notamment le fait que les arbres sont des êtres sociaux. Ils peuvent compter, apprendre et mémoriser, se comporter en infirmiers pour les voisins malades.', 'https://www.amazon.fr/Vie-secr%C3%A8te-arbres-Peter-Wohlleben/dp/2352045932/ref=zg_bs_books_7?_encoding=UTF8&amp;psc=1&amp;refRID=H0FQ7Z14WGR5YSN8TCAX', '0000-00-00', 1, 0, 0),
(4, '1', '4', 'La Servante écarlate', 'Margaret Atwood', '/view/assets/img/works/1_4_595a5f40ea890.jpg', 'Devant la chute drastique de la fécondité, la république de Gilead, récemment fondée par des fanatiques religieux, a réduit au rang d\'esclaves sexuelles les quelques femmes encore fertiles. Vêtue de rouge, Defred, &quot; servante écarlate &quot; parmi d\'autres, à qui l\'on a ôté jusqu\'à son nom, met donc son corps au service de son Commandant et de son épouse. Le soir, en regagnant sa chambre à l\'austérité monacale, elle songe au temps où les femmes avaient le droit de lire, de travailler...', 'https://www.amazon.fr/Servante-%C3%A9carlate-Margaret-ATWOOD/dp/2221203321/ref=zg_bs_books_10?_encoding=UTF8&amp;psc=1&amp;refRID=H0FQ7Z14WGR5YSN8TCAX', '0000-00-00', 1, 0, 0),
(5, '1', '5', 'Le temps est assassin', 'Michel Bussi', '/view/assets/img/works/1_5_595a5f2c4b45c.jpg', 'Été 1989. La Corse, presqu\'île de la Revellata, entre mer et montagne. Sur cette route de corniche, au-dessus d\'un ravin de vingt mètres, une voiture roule trop vite et bascule dans le vide. Une seule survivante : Clotilde, quinze ans. Ses parents et son frère n\'ont pas eu la même chance. &lt;br /&gt;<br />\r\nÉté 2016. Clotilde revient pour la première fois sur les lieux du drame, accompagnée de son mari et de sa fille adolescente. Elle veut profiter de ces vacances pour exorciser le passé. C\'est au camping dans lequel elle a vécu son dernier été avec ses parents que l\'attend une lettre... de sa mère. Vivante ?', 'https://www.amazon.fr/temps-est-assassin-Michel-BUSSI/dp/226627418X/ref=zg_bs_books_24?_encoding=UTF8&amp;psc=1&amp;refRID=A5JQ2PSSHSQFSWF96C8S', '0000-00-00', 1, 0, 0),
(6, '1', '5', 'Rêver', 'Franck Thilliez', '/view/assets/img/works/1_5_595a5f1c4425d.jpg', 'Psychologue réputée pour son expertise dans les affaires criminelles, Abigaël souffre d\'une narcolepsie sévère qui lui fait confondre le rêve avec la réalité. De nombreux mystères planent autour de la jeune femme, notamment concernant l\'accident qui a coûté la vie à son père et à sa fille, et dont elle est miraculeusement sortie indemne. &lt;br /&gt;<br />\r\nL\'affaire de disparition d\'enfants sur laquelle elle travaille brouille ses derniers repères et fait bientôt basculer sa vie dans un cauchemar éveillé... Dans cette enquête, il y a une proie et un prédateur : elle-même.', 'https://www.amazon.fr/R%C3%AAver-Franck-THILLIEZ/dp/2266276549/ref=zg_bs_books_26?_encoding=UTF8&amp;psc=1&amp;refRID=A5JQ2PSSHSQFSWF96C8S', '0000-00-00', 1, 0, 0),
(7, '1', '5', 'Quand sort la recluse', 'Fred Vargas', '/view/assets/img/works/1_5_595a5f0dca2d3.jpg', '« - Trois morts, c\'est exact, dit Danglard. Mais cela regarde les médecins, les épidémiologistes, les zoologues. Nous, en aucun cas. Ce n\'est pas de notre compétence. &lt;br /&gt;<br />\r\n- Ce qu\'il serait bon de vérifier, dit Adamsberg. J\'ai donc rendez-vous demain au Muséum d\'Histoire naturelle. &lt;br /&gt;<br />\r\n- Je ne veux pas y croire, je ne veux pas y croire. Revenez-nous, commissaire. Bon sang mais dans quelles brumes avez-vous perdu la vue ? &lt;br /&gt;<br />\r\n- Je vois très bien dans les brumes, dit Adamsberg un peu sèchement, en posant ses deux mains à plat sur la table. Je vais donc être net. Je crois que ces trois hommes ont été assassinés. &lt;br /&gt;<br />\r\n- Assassinés, répéta le commandant Danglard. Par l\'araignée recluse ? »', 'https://www.amazon.fr/Quand-sort-recluse-Fred-Vargas/dp/2081413140/ref=zg_bs_9691469031_1?_encoding=UTF8&amp;psc=1&amp;refRID=7P7ZSDPJ81D7QXARHQN7', '0000-00-00', 1, 0, 0),
(8, '2', '6', 'Vaiana', 'Disney', '/view/assets/img/works/2_6_595a5f0406415.jpeg', 'Il y a 3 000 ans, les plus grands marins du monde voyagèrent dans le vaste océan Pacifique, à la découverte des innombrables îles de l\'Océanie. Mais pendant le millénaire qui suivit, ils cessèrent de voyager. Et personne ne sait pourquoi... Vaiana, la légende du bout du monde raconte l\'aventure d\'une jeune fille téméraire qui se lance dans un voyage audacieux pour accomplir la quête inachevée de ses ancêtres et sauver son peuple. Au cours de sa traversée du vaste océan, Vaiana va rencontrer Maui, un demi-dieu. Ensemble, ils vont accomplir un voyage épique riche d\'action, de rencontres et d\'épreuves... En accomplissant la quête inaboutie de ses ancêtres, Vaiana va découvrir la seule chose qu\'elle a toujours cherchée : elle-même.', 'https://www.amazon.fr/Ballerina-Camille-Cottin/dp/B01MYWEVEL/ref=sr_1_3?s=dvd&amp;ie=UTF8&amp;qid=1499009898&amp;sr=1-3', '0000-00-00', 0, 0, 0),
(9, '2', '7', 'La La Land', 'Damien Chazelle', '/view/assets/img/works/2_7_595a5efa57f37.png', 'Au coeur de Los Angeles, une actrice en devenir prénommée Mia sert des cafés entre deux auditions. De son côté, Sebastian, passionné de jazz, joue du piano dans des clubs miteux pour assurer sa subsistance. Tous deux sont bien loin de la vie rêvée à laquelle ils aspirent... Le destin va réunir ces doux rêveurs, mais leur coup de foudre résistera-t-il aux tentations, aux déceptions, et à la vie trépidante d\'Hollywood ?', 'https://www.amazon.fr/land-DVD-Ryan-Gosling/dp/B01LTI9DUO/ref=sr_1_8?s=dvd&amp;ie=UTF8&amp;qid=1499009898&amp;sr=1-8', '0000-00-00', 1, 0, 0),
(10, '2', '8', 'Underworld : Blood Wars', 'Anna Foerster', '/view/assets/img/works/2_8_595a5ef12e83e.jpg', 'La chasseuse de lycans Selene fait face aux agressions brutales des clans lycans et vampires qui l\'ont trahie. Avec ses seuls alliés, David et son père Thomas, elle doit mettre fin à la guerre sempiternelle entre les deux clans, même si cela implique pour elle de faire le sacrifice ultime.', 'https://www.amazon.fr/Underworld-Blood-Wars-Copie-digitale/dp/B06XH5MFXD/ref=sr_1_11?s=dvd&amp;ie=UTF8&amp;qid=1499009898&amp;sr=1-11', '0000-00-00', 1, 0, 0),
(11, '2', '4', 'Star Wars : Rogue One', 'Gareth Edwards', '/view/assets/img/works/2_4_595a5ee71f9ed.jpg', 'Jyn Erso est encore enfant sur la planète Lah\'mu, quand une troupe de l\'Empire galactique menée par Orson Krennic vient chercher son père, Galen Erso, ingénieur ayant fui l\'Empire, pour l\'emmener de force terminer la construction de l\'Étoile de la mort. Ils tuent sa mère Lyra, tandis que Jyn part se cacher sous une trappe dans une grotte. Après leur départ, Saw Gerrera, ami de la famille et opposant à l\'Empire galactique, vient la récupérer, et il s\'occupera de sa formation. Quinze ans plus tard, Jyn vit sous une fausse identité. Capturée et envoyée dans un camp de travail de l\'Empire sur Wobani, elle est libérée de sa geôle par des membres de l\'Alliance Rebelle menés par le capitaine Cassian Andor. Ils l\'emmènent sur la base secrète de l\'Alliance, la lune Yavin IV.', 'https://www.amazon.fr/Rogue-One-Star-Wars-Story/dp/B01LTI0GX2/ref=sr_1_14?s=dvd&amp;ie=UTF8&amp;qid=1499009898&amp;sr=1-14', '0000-00-00', 0, 0, 0),
(12, '2', '9', 'Split', 'Night Shyamalan', '/view/assets/img/works/2_9_595a5ede6e923.jpg', 'Kevin a déjà révélé 23 personnalités, avec des attributs physiques différents pour chacune, à sa psychiatre dévouée, la docteure Fletcher, mais l\'une d\'elles reste enfouie au plus profond de lui. Elle va bientôt se manifester et prendre le pas sur toutes les autres. Poussé à kidnapper trois adolescentes, dont la jeune Casey, aussi déterminée que perspicace, Kevin devient dans son âme et sa chair, le foyer d\'une guerre que se livrent ses multiples personnalités, alors que les divisions qui régnaient jusqu\'alors dans son subconscient volent en éclats...', 'https://www.amazon.fr/Split-Anya-Taylor-Joy/dp/B06XRQXNT4/ref=sr_1_15?s=dvd&amp;ie=UTF8&amp;qid=1499009898&amp;sr=1-15', '0000-00-00', 0, 0, 0),
(13, '2', '10', 'Les Animaux Fantastiques', 'David Yates', '/view/assets/img/works/2_10_595a5ed33af5b.jpeg', 'New York, 1926. Le monde des sorciers est en grand danger. Une force mystérieuse sème le chaos dans les rues de la ville : la communauté des sorciers risque désormais d\'être à la merci des Fidèles de Salem, groupuscule fanatique des Non-Maj\' (version américaine du &quot;Moldu&quot;) déterminé à les anéantir. Quant au redoutable sorcier Gellert Grindelwald, après avoir fait des ravages en Europe, il a disparu... et demeure introuvable. Ignorant tout de ce conflit qui couve, Norbert Dragonneau débarque à New York au terme d\'un périple à travers le monde : il a répertorié un bestiaire extraordinaire de créatures fantastiques dont certaines sont dissimulées dans les recoins magiques de sa sacoche en cuir...', 'https://www.amazon.fr/Animaux-fantastiques-Eddie-Redmayne/dp/B01LTHYTT0/ref=sr_1_13?s=dvd&amp;ie=UTF8&amp;qid=1499009898&amp;sr=1-13', '0000-00-00', 0, 0, 0),
(14, '2', '9', 'Alien : Covenant', 'Ridley Scott', '/view/assets/img/works/2_9_595a5ec5375fd.jpg', '10 ans après Prometheus. Le vaisseau spatial Covenant est en route pour la lointaine planète Origae-6 afin d\'y établir une colonie, un nouvel avant-poste pour l\'humanité. Mais un incident grave contraint le vaisseau à se dérouter vers une autre planète émettant un étrange signal, située à une distance plus proche et qui a tout d\'un paradis terrestre.', 'https://www.amazon.fr/Alien-Covenant-DVD-Digital-HD/dp/B071NSG5Q9/ref=sr_1_9?s=dvd&amp;ie=UTF8&amp;qid=1499010763&amp;sr=1-9', '0000-00-00', 0, 0, 0),
(15, '1', '10', 'Harry Potter à l\'école des sorciers', 'J. K. Rowling', '/view/assets/img/works/1_10_595a5eb8a243b.jpg', 'Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l\'emmener à Poudlard, une école de sorcellerie !Voler en balai, jeter des sorts, combattre les trolls : Harry Potter se révèle un sorcier doué. Mais un mystère entoure sa naissance et l\'effroyable V..., le mage dont personne n\'ose prononcer le nom.', 'https://www.amazon.fr/Harry-Potter-I-Harry-sorciers/dp/2070643026/ref=sr_1_2?s=books&amp;ie=UTF8&amp;qid=1499011414&amp;sr=1-2&amp;keywords=harry+potter', '0000-00-00', 0, 0, 0),
(16, '1', '10', 'Harry Potter et la Chambre des Secrets', 'J.K. Rowling', '/view/assets/img/works/1_10_5963ea2924ccb.', 'Une rentrée fracassante en voiture volante, une étrange malédiction qui s’abat sur les élèves, cette deuxième année à l’école des sorciers ne s’annonce pas de tout repos! Entre les cours de potions magiques, les matches de Quidditch et les combats de mauvais sorts, Harry et ses amis Ron et Hermione trouveront-ils le temps de percer le mystère de la Chambre des Secrets? Le deuxiè me volume des aventures de Harry Potter : un livre magique pour sorciers confirmés.', '', '2015-12-08', 0, 0, 0),
(17, '1', '10', 'Harry Potter et le Prisonnier d’Azkaban', 'J.K. Rowling', '/view/assets/img/works/1_10_5963ef95a042c.', 'Sirius Black, le dangereux criminel qui s’est échappé de la forteresse d’Azkaban, recherche Harry Potter. C’est donc sous bonne garde que l’apprenti sorcier fait sa troisième rentrée. Au programme : des cours de divination, la fabrication d’une potion de Ratatinage, le dressage des hippogriffes... Mais Harry est-il vraiment à l’abri du danger qui le menace? Le troisième tome des aventures de Harry Potter vous emportera dans un tourbillon de surprises et d’émotions. Frissons et humour garantis!', '', '2015-12-08', 0, 0, 0),
(18, '1', '10', 'Harry Potter et la Coupe de Feu', 'J.K. Rowling', '/view/assets/img/works/1_1_59649fcd76560.', 'Harry Potter a quatorze ans et entre en quatrième année au collège de Poudlard. Une grande nouvelle attend Harry, Ron et Hermione à leur arrivée : la tenue d’un tournoi de magie exceptionnel entre les plus célèbres écoles de sorcellerie. Déjà les délégations étrangères font leur entrée. Harry se réjouit... Trop vite. Il va se trouver plongé au coeur des événements les plus dramatiques qu’il ait jamais eu à affronter. Dans ce quatrième tome bouleversant, drôle, fascinant, qui révèle la richesse des enjeux en cours, Harry Potter doitfaire face et relever d’immenses défis.', '', '2015-12-08', 0, 0, 0),
(19, '1', '10', 'Harry Potter et l’Ordre du Phénix', 'J.K. Rowling', '/view/assets/img/works/1_1_59649fe9b609e.', 'À quinze ans, Harry entre en cinquième année à Poudlard, mais il n’a jamais été si anxieux. L’adolescence, la perspective des examens et ces étranges cauchemars... Car Celui-Dont-On-Ne-Doit-Pas-Prononcer- Le-Nom est de retour. Le ministère de la Magie semble ne pas prendre cette menace au sérieux, contrairement à Dumbledore. La résistance s’organise alors autour de Harry qui va devoir compter sur le courage et la fidélité de ses amis de toujours... D’une inventivité et d’une virtuosité rares, découvrez le cinquième tome de cette saga que son auteur a su hisser au rang de véritable phénomène littéraire.', '', '2015-12-08', 0, 0, 0),
(20, '1', '10', 'Harry Potter Et Le Prince de Sang-Mêlé', 'J. K. Rowling', '/view/assets/img/works/1_1_5964a028f0179.', 'Dans un monde de plus en plus inquiétant, Harry se prépare à retrouver Ron et Hermione. Bientôt, ce sera la rentrée à Poudlard, avec les autres étudiants de sixième année. Mais pourquoi le professeur Dumbledore vient-il en personne chercher Harry chez les Dursley ? Harry, Ron et Hermione entrent en sixième année à Poudlard où ils vont vivre leur dernière année avant la majorité qui est fixée, chez les sorciers, à l\'âge de dix-sept ans. Des événements particulièrement marquants vont contribuer à faire passer Harry du statut d\'adolescent à celui d\'homme. Ce tome, sur fond de guerre contre un Voldemort plus puissant que jamais, se révèle plus sombre que les précédents. Secrets, alliances et trahisons conduisent aux événements les plus dramatiques qu\'Harry ait eu à affronter. Mais, en dépit de ces épisodes tragiques, il émane du texte un sentiment général d\'allégresse et de joie de vivre dû à l\'humour, aux preuves d\'amitié, aux scènes romantiques, à de nouvelles trouvailles poétiques de J K Rowling, mais surtout à la sérénité retrouvée de Harry qui reprend confiance en lui. Ce dernier se plonge également dans les souvenirs d\'enfance de Voldemort. Il va ainsi mieux comprendre la personnalité de son adversaire car même cet être monstrueux possède une part d\'humanité. Le sens des responsabilités et du sacrifice revêtent, ici encore, une dimension particulièrement importante.', '', '0000-00-00', 0, 0, 0),
(21, '1', '10', 'Harry Potter et les Reliques de la Mort', 'J.K. Rowling', '/view/assets/img/works/1_10_5964a052e22d9.', 'Cette année, Harry a dix-sept ans et ne retourne pas à Poudlard. Avec Ron et Hermione, il se consacre à la dernière mission confiée par Dumbledore. Mais le Seigneur des Ténèbres règne en maître. Traqués, les trois fidèles amis sont contraints à la clandestinité. D’épreuves en révélations, le courage, les choix et les sacrifices de Harry seront déterminants dans la lutte contre les forces du Mal. Avec le dénouement de l’héroïque histoire de Harry Potter, J.K. Rowling signe un chef-d’oeuvre d’une grande humanité et d’une maîtrise incomparable.', '', '2015-12-08', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbox`
--
ALTER TABLE `chatbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_items`
--
ALTER TABLE `custom_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchanges`
--
ALTER TABLE `exchanges`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_messages`
--
ALTER TABLE `admin_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `chatbox`
--
ALTER TABLE `chatbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `custom_items`
--
ALTER TABLE `custom_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `exchanges`
--
ALTER TABLE `exchanges`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `salons`
--
ALTER TABLE `salons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
