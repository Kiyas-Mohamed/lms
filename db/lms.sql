-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 08:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `profile` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `status`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'Sylvia Plath', '1', '1.jpg', '2022-11-23 06:30:17', '2022-11-23 06:30:17'),
(2, 'Oscar Wilde', '1', '2.jpg', '2022-11-23 06:30:30', '2022-11-23 06:30:30'),
(3, 'Dashiell Hammett', '1', '3.jpg', '2022-11-23 06:30:42', '2022-11-23 06:30:42');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `books_status` enum('1','0') NOT NULL DEFAULT '0',
  `images` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `description`, `category_id`, `author_id`, `quantity`, `books_status`, `images`, `created_at`, `updated_at`) VALUES
(1, 'Twisted Love', 'He has a heart of ice … but for her, he\'d burn the world. Alex Volkov is a devil blessed with the face of an angel and cursed with a past he can\'t escape. Driven by a tragedy that has haunted him for most of his life, his ruthless pursuits for success and vengeance leave little room for matters of the heart. But when he\'s forced to look after his', 3, 1, 1, '1', '1.jpg', '2022-11-23 06:34:32', '2022-11-23 06:34:32'),
(2, 'The God Delusion', 'Publication Date: January 16, 2008\r\nA preeminent scientist—and the world\'s most prominent atheist—asserts the irrationality of belief in God and the grievous harm religion has inflicted on society, from the Crusades to 9/11.\r\n\r\nWith rigor and wit, Dawkins examines God in all his forms, from the sex-obsessed tyrant of the Old Testament to the more benign (but still illogical) Celestial Watchmaker favored by some Enlightenment thinkers. He eviscerates the major arguments for religion and demonstrates the supreme improbability of a supreme being. He shows how religion fuels war, foments bigotry, and abuses children, buttressing his points with historical and contemporary evidence. The God Delusion makes a compelling case that belief in God is not just wrong but potentially deadly. It also offers exhilarating insight into the advantages of atheism to the individual and society, not the least of which is a clearer, truer appreciation of the universe\'s wonders than any faith could ever muster.', 3, 2, 1, '1', '2.jpg', '2022-11-23 07:15:52', '2022-11-23 07:15:52'),
(3, 'La hipótesis del amor', 'Olive Smith es una doctoranda de tercer año que no cree en las relaciones amorosas duraderas, pero su mejor amiga, Ahn, sí, y por eso Olive se ha metido en un lío monumental. A Ahn le gusta el exnovio de Olive, pero jamás daría el primer paso porque es una buena amiga. A Olive no le va a resultar nada fácil convencerla de que ha pasado página, puesto que los científicos necesitan pruebas. Por eso, como cualquier mujer con un mínimo de amor propio, se deja llevar por el pánico y besa al primer hombre con el que se encuentra para que Ahn la vea. Ese hombre es nada más y nada menos que Adam Carlsen, un joven profesor tan reputado por la calidad de su trabajo como por su imbecilidad. Así que Olive se queda de piedra cuando Carlsen accede a mantener su farsa en secreto y ser su novio falso. Sin embargo, después de que un importante congreso científico se convierta en un desastre y Adam vuelva a sorprenderla con su apoyo inquebrantable (y sus inquebrantables abdominales), su pequeño experimento se acerca peligrosamente al punto de combustión. Olive no tarda en descubrir que la única cosa más complicada que una hipótesis sobre el amor es analizar su propio corazón bajo el microscopio.', 3, 1, 1, '1', '3.jpg', '2022-11-23 07:18:41', '2022-11-23 07:18:41'),
(4, 'Shatter me', 'Ostracized or incarcerated her whole life, seventeen-year-old Juliette is freed on the condition that she use her horrific abilities in support of The Reestablishment, a post-apocalyptic dictatorship, but Adam, the only person ever to show her affection, offers hope of a better future.', 3, 3, 1, '1', '4.jpg', '2022-11-23 07:20:06', '2022-11-23 07:20:06'),
(5, 'IT', 'Derry: A small city in Maine, place as hauntingly familiar as your own hometown, only in Derry the haunting is real...\r\n\r\nThey were seven teenagers when they first stumbled upon the horror. Now they are grown-up men and women who have gone out into the big world to gain success and happiness. But none of them can withstand the force that has drawn them back to Derry to face the nightmare without an end, and the evil without a name.', 4, 3, 1, '1', '5.jpg', '2022-11-23 07:28:47', '2022-11-23 07:28:47'),
(6, 'Pet Sematary', 'Pet Sematary is a 1983 horror novel by American writer Stephen King. The novel was nominated for a World Fantasy Award for Best Novel in 1986.', 4, 2, 1, '1', '6.jpg', '2022-11-23 07:34:16', '2022-11-23 07:34:16'),
(7, 'Eyes of Darkness', 'Tina Evans has spent a year suffering from incredible heartache since her son Danny\'s tragic death. But now, with her Vegas show about to premiere, Tina can think of no better time for a fresh start. Maybe she can finally move on and put her grief behind her.\r\n\r\nOnly there is a message for Tina, scrawled on the chalkboard in Danny\'s room: NOT DEAD. Two words that send her on a terrifying journey from the bright lights of Las Vegas to the cold shadows of the High Sierras, where she uncovers a terrible secret.', 4, 3, 1, '1', '7.jpg', '2022-11-23 07:35:25', '2022-11-23 07:35:25'),
(8, 'Cell', 'On October 1, God is in His heaven, the stock market stands at 10,140, most of the planes are on time, and Clayton Riddell, an artist from Maine, is almost bouncing up Boylston Street in Boston. He\'s just landed a comic book deal that might finally enable him to support his family by making art instead of teaching it. He\'s already picked up a small (but expensive!) gift for his long-suffering wife, and he knows just what he\'ll get for his boy Johnny. Why not a little treat for himself? Clay\'s feeling good about the future.\r\n\r\nThat changes in a hurry. The cause of the devastation is a phenomenon that will come to be known as The Pulse, and the delivery method is a cell phone. Everyone\'s cell phone. Clay and the few desperate survivors who join him suddenly find themselves in the pitch-black night of civilization\'s darkest age, surrounded by chaos, carnage, and a human horde that has been reduced to its basest nature. . .and then begins to evolve.', 4, 1, 1, '1', '8.jpg', '2022-11-23 07:38:29', '2022-11-23 07:38:29'),
(9, 'Livewire Sci-Fi', 'SCIENCE FICTION is a fictionalized story wherein the setting and plot are centered around technology, time travel, outer space, or scientific principles, with or without the presence of aliens', 1, 2, 1, '1', '9.jpg', '2022-11-23 08:27:03', '2022-11-23 08:27:03'),
(10, 'The Moonstone', 'One of the first English detective novels, this mystery involves the disappearance of a valuable diamond, originally stolen from a Hindu idol, given to a young woman on her eighteenth birthday, and then stolen again. A classic of 19th-century literature.', 1, 1, 1, '1', '10.jpg', '2022-11-23 08:31:56', '2022-11-23 08:32:51'),
(11, 'The mysterious affair at Styles', 'CRIME & MYSTERY. With impeccable timing Hercule Poirot, the renowned Belgian detective, makes his dramatic entrance on to the English crime stage. Recently, there had been some strange goings on at Styles St Mary. Evelyn, constant companion to old Mrs Inglethorp, had stormed out of the house muttering something about \'a lot of sharks\'. And with her, something indefinable had gone from the atmosphere. Her presence had spelt security; now the air seemed rife with suspicion and impending evil. A shattered coffee cup, a splash of candle grease, a bed of begonias. all Poirot required to display his now legendary powers of detection.', 1, 1, 1, '1', '11.jpg', '2022-11-23 08:34:01', '2022-11-23 08:34:01'),
(12, 'Le Chien des Baskerville', 'In this classic mystery set in 19th-century England, Sherlock Holmes and Dr. Watson are faced with discovering the truth behind the curse on the wealthy Baskerville family.\r\n\r\nWe owe The Hound of the Baskervilles (1902) to Arthur Conan Doyle\'s good friend Fletcher \"Bobbles\" Robinson, who took him to visit some scary English moors and prehistoric ruins, and told him marvelous local legends about escaped prisoners and a 17th-century aristocrat who fell afoul of the family dog.', 1, 2, 1, '1', '12.jpg', '2022-11-23 08:35:20', '2022-11-23 08:35:20'),
(13, 'Le Crime De L\'Orient-Express', 'While en route from Syria to Paris, in the middle of a freezing winter\'s night, the Orient Express is stopped dead in its tracks by a snowdrift. Passengers awake to find the train still stranded and to discover that a wealthy American has been brutally stabbed to death in his private compartment. Incredibly, that compartment is locked from the inside. With no escape into the wintery landscape the killer must still be on board. Fortunately, the brilliant Belgian inspector Hercule Poirot is also on board, having booked the last available berth.\r\n\r\nMurder on the Orient Express is one of Agatha Christie’s most famous novels, owing no doubt to a combination of its romantic setting and the ingeniousness of its plot; its non-exploitative reference to the sensational kidnapping and murder of the infant son of Charles and Anne Morrow Lindbergh only two years prior; and a popular 1974 film adaptation, starring Albert Finney as Poirot - one of the few cinematic versions of a Christie work that met with the approval, however mild, of the author herself.', 2, 3, 1, '1', '13.jpg', '2022-11-23 08:41:42', '2022-11-23 08:41:42'),
(14, 'Artists in Crime', 'When murder upsets the creative tranquillity of an artists\' colony, Scotland Yard sends in its most famous investigator. And what begins as a routine case turns out to be the most momentous of Roderick Alleyn\'s career. For before he can corner the killer, his heart is captured by one of the suspects-the flashing-eyed painter Agatha Troy, who has nothing but scorn for the art of detection.', 2, 1, 1, '1', '14.jpg', '2022-11-23 08:43:04', '2022-11-23 08:43:04'),
(15, 'The Crime at Black Dudley', 'The Black Dudley is an ancient, remote mansion inhabited by recluse, Colonel Combe, but owned by Waytt Petrie, a young academic who decides to revive his property with a weekend party to which he invites his friends and colleagues. Among the guests is George Abbershaw, a renowned doctor and pathologist who is occasionally summoned by Scotland Yard to help with consulting mysterious deaths. Abbershaw hopes that the leisurely weekend at Black Dudley will help him to get acquainted with red-haired Meggie Oliphant whom he quietly admires.', 2, 2, 1, '1', '15.jpg', '2022-11-23 08:46:42', '2022-11-23 08:46:42'),
(16, 'The Murder on the Links', 'Belgian detective Hercule Poirot is summoned to France after receiving a distressing letter with a urgent cry for help. Upon his arrival in Merlinville-sur-Mer, the investigator finds the man who penned the letter, the South American millionaire Monsieur Renauld, stabbed to death and his body flung into a freshly dug open grave on the golf course adjoining the property. Meanwhile the millionaire\'s wife is found bound and gagged in her room. Apparently, it seems that Renauld and his wife were victims of a failed break-in, resulting in Renauld\'s kidnapping and death.', 2, 2, 1, '1', '16.jpg', '2022-11-23 08:48:10', '2022-11-23 08:48:10'),
(17, 'Ugly Love', 'ATTRACTION AT FIRST SIGHT CAN BE MESSY… When Tate Collins finds airline pilot Miles Archer passed out in front of her apartment door, it is definitely not love at first sight. They wouldn’t even go so far as to consider themselves friends. But what they do have is an undeniable mutual attraction. He doesn’t want love and she doesn’t have time for a relationship, but their chemistry cannot be ignored. Once their desires are out in the open, they realize they have the perfect set-up, as long as Tate can stick to two rules: Never ask about the past and don’t expect a future. Tate is determined that she can handle it, but when she realises that she can’t, will she be able to say no to her sexy pilot when he lives just next door?', 3, 1, 1, '1', '17.jpg', '2022-11-23 08:54:46', '2022-11-23 08:54:47'),
(18, 'The last Olympian', 'Percy Jackson and his army of young demigods do battle with Kronos on the streets of Manhattan as Percy\'s sixteenth birthday approaches and his fate looms even closer.', 4, 2, 1, '1', '18.jpg', '2022-11-23 08:56:15', '2022-11-23 08:56:15'),
(19, 'Verity', 'Die Jungautorin Lowen Ashleigh bekommt ein Angebot, das sie unmöglich ablehnen kann: Sie soll die gefeierten Psychothriller von Starautorin Verity Crawford zu Ende schreiben. Diese ist seit einem Autounfall, der unmittelbar auf denTod ihrer beiden Töchter folgte, nicht mehr ansprechbar und ein dauerhafter Pflegefall.\r\n\r\nLowen akzeptiert – auch, weil sie sich zu Veritys Ehemann Jeremy hingezogen fühlt. Während ihrer Recherchen im Haus der Crawfords findet sie Veritys Tagebuch und darin offenbart sich Lowen Schreckliches ', 1, 2, 1, '1', '19.jpg', '2022-11-23 08:57:10', '2022-11-23 08:57:10'),
(20, 'The Thorn of Emberlain', 'A new chapter for Locke and Jean and finally the war that has been brewing in the Kingdom of the Marrows flares up and threatens to capture all in its flames.\r\n\r\nAnd all the while Locke must try to deal with the disturbing rumours about his past revealed in The Republic of Thieves. Fighting a war when you don\'t know the truth of right and wrong is one thing. Fighting a war when you don\'t know the truth of yourself is quite another. Particularly when you\'ve never been that good with a sword anyway.', 2, 3, 1, '1', '20.jpg', '2022-11-23 08:58:29', '2022-11-23 08:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sci-Fi', '1', '2022-11-23 06:31:06', '2022-11-23 06:31:06'),
(2, 'Crime', '1', '2022-11-23 06:31:18', '2022-11-23 06:31:18'),
(3, 'Love', '1', '2022-11-23 06:31:35', '2022-11-23 06:31:35'),
(4, 'Horror', '1', '2022-11-23 06:31:47', '2022-11-23 06:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `fine_date` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lendings`
--

CREATE TABLE `lendings` (
  `lend_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lendings_status` enum('1','0') NOT NULL DEFAULT '0',
  `received_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `given_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(99) NOT NULL,
  `role` enum('1','0') NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `profile` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`),
  ADD UNIQUE KEY `author_name` (`author_name`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `lendings`
--
ALTER TABLE `lendings`
  ADD PRIMARY KEY (`lend_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lendings`
--
ALTER TABLE `lendings`
  MODIFY `lend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
