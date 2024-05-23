-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:17 AM
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
-- Database: `language translation tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `dictionary`
--

CREATE TABLE `dictionary` (
  `Word_id` int(10) NOT NULL,
  `Word` varchar(30) DEFAULT NULL,
  `Definition` text DEFAULT NULL,
  `ExampleSetence` text DEFAULT NULL,
  `Language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dictionary`
--

INSERT INTO `dictionary` (`Word_id`, `Word`, `Definition`, `ExampleSetence`, `Language_id`) VALUES
(2, 'Hy', 'It is A common greeting', '\'Hy Dora!\'', 1),
(3, 'Bonjour', 'A French greeting equivalent to \"Hello\" in English.', '\"Bonjour, comment ça va?\"', 6),
(4, 'Thank you', 'IT is an english word which used to appreciate someone who done well.', '\"Thank you!for your help\"', 1),
(5, 'Hello', 'Used as a greeting or to begin a conversation.', '0', 6);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Feedback_id` int(10) NOT NULL,
  `Rating` varchar(10) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Feedback_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `User_id` int(11) DEFAULT NULL,
  `Translation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Feedback_id`, `Rating`, `Comment`, `Feedback_date`, `User_id`, `Translation_id`) VALUES
(1, 'Good', 'I am satisfy becouse of question I get', '2024-04-30 22:00:00', 2, 8),
(2, 'Not very g', 'Improve the capacity of translation', '0000-00-00 00:00:00', 2, 7),
(3, 'Good', 'Great translation work! Very accurate and timely.', '0000-00-00 00:00:00', 4, 9),
(4, 'Not good a', 'Good effort, but there were a few mistakes in the translation.', '0000-00-00 00:00:00', 2, 8),
(5, 'Bad', 'Disappointed with the quality of the translation. It needs improvement.', '0000-00-00 00:00:00', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `glossary`
--

CREATE TABLE `glossary` (
  `Term_id` int(10) NOT NULL,
  `Term` varchar(20) DEFAULT NULL,
  `Definition` text DEFAULT NULL,
  `CreatedDate` date DEFAULT NULL,
  `Language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `glossary`
--

INSERT INTO `glossary` (`Term_id`, `Term`, `Definition`, `CreatedDate`, `Language_id`) VALUES
(1, 'English term,Algorit', 'A step-by-step procedure for solving a problem or accomplishing some end, especially by a computer', '0000-00-00', 1),
(2, 'Spanish term,Algorit', 'Un procedimiento paso a paso para resolver un problema o lograr un fin, especialmente mediante una computadora.', '0000-00-00', 3),
(3, 'Database', 'An organized collection of data, generally stored and accessed electronically from a computer system.', '0000-00-00', 5),
(4, 'French term,Algorith', 'Une procédure étape par étape pour résoudre un problème ou atteindre un objectif, notamment par un ordinateur.', '0000-00-00', 4),
(5, 'English term,Artific', 'The simulation of human intelligence processes by machines, especially computer systems.', '0000-00-00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `Language_id` int(10) NOT NULL,
  `Language_name` varchar(15) DEFAULT NULL,
  `ISO_Code` varchar(30) DEFAULT NULL,
  `Native_name` varchar(40) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`Language_id`, `Language_name`, `ISO_Code`, `Native_name`, `Country`, `Description`) VALUES
(1, 'English', 'en', 'English', 'Nigeria', 'It is the primary language of communication in man'),
(3, 'English', 'en', 'English', 'Canada', 'It is the primary language of communication in many countries and is used extensively in business, education, and media.'),
(4, 'French', 'fr', 'francais', 'France', 'French is a Romance language spoken by millions of people around the world. It is known for its rich literary tradition, cultural influence, and widespread use in diplomacy and international organizations.'),
(5, 'Spanish', 'es', 'Espanol', 'Colombia', ' Spanish is one of the most widely spoken languages globally, with a rich history and cultural significance. It is the official language of many countries and is known for its vibrant literature, music, and arts.'),
(6, 'Arabic', 'ar', 'Al-Arabiyya', 'Egypt', 'Arabic is a Semitic language with a rich history and cultural significance. It is the language of the Quran and is widely spoken across the Middle East and North Africa. It has diverse dialects and is used in various domains, including literature, religio');

-- --------------------------------------------------------

--
-- Table structure for table `sourcetext`
--

CREATE TABLE `sourcetext` (
  `SourceText_id` int(10) NOT NULL,
  `Text` text DEFAULT NULL,
  `Author` varchar(50) DEFAULT NULL,
  `Creation_date` date DEFAULT NULL,
  `LastModifiedDate` date DEFAULT NULL,
  `Category` varchar(30) DEFAULT NULL,
  `Status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sourcetext`
--

INSERT INTO `sourcetext` (`SourceText_id`, `Text`, `Author`, `Creation_date`, `LastModifiedDate`, `Category`, `Status`) VALUES
(1, '\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\" \"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...\"', 'Marketing Department', '2023-05-02', '2023-06-07', 'Marketing', 'In Progress'),
(2, '\'The primary function of this device is to convert electrical energy into mechanical motion.', 'Engineering Team', '2023-03-21', '2023-04-30', 'Technical', 'pending'),
(3, '\'The primary function of this device is to convert electrical energy into mechanical motion.', 'Engineering Team', '2023-03-21', '2023-04-30', 'Technical', 'In Progress'),
(4, 'Introducing our latest product line! Experience the ultimate in comfort and style with our innovative designs.', 'Marketing Department', '2022-03-02', '2022-03-24', 'Marketing', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

CREATE TABLE `translation` (
  `Translation_id` int(10) NOT NULL,
  `Translation_date` date DEFAULT NULL,
  `Translatedtext` text DEFAULT NULL,
  `SourceText_id` int(11) DEFAULT NULL,
  `Language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `translation`
--

INSERT INTO `translation` (`Translation_id`, `Translation_date`, `Translatedtext`, `SourceText_id`, `Language_id`) VALUES
(7, '2024-05-02', '\"What time does the movie start?\"', 2, 6),
(8, '2024-05-01', '\"I went to the store.\"', 1, 5),
(9, '2023-04-05', 'Ladies and gentlemen, please remain seated until the train comes to a complete stop.', 1, 1),
(14, NULL, NULL, 2, 6),
(15, '2024-05-04', 'The only thing we have to fear is fear itself.', 3, 6),
(16, '2022-03-18', 'A journey of a thousand miles begins with a single step.', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `translationhistory`
--

CREATE TABLE `translationhistory` (
  `History_id` int(10) NOT NULL,
  `Action` varchar(20) DEFAULT NULL,
  `Action_date` datetime DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `Translation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `translationhistory`
--

INSERT INTO `translationhistory` (`History_id`, `Action`, `Action_date`, `Comments`, `Translation_id`) VALUES
(1, 'Delete', '2024-05-01 00:00:00', 'Delete duplication records', 9),
(2, 'Delete', '2024-05-01 00:00:00', 'Removed duplicate translation.', 9),
(3, 'Update', '2024-05-03 00:00:00', 'Updated translation based on user feedback.', 7),
(4, 'Insert', '2024-05-01 00:00:00', 'Added new translation for a new source text.', 14);

-- --------------------------------------------------------

--
-- Table structure for table `translationmemory`
--

CREATE TABLE `translationmemory` (
  `Memory_id` int(10) NOT NULL,
  `TargetText` text DEFAULT NULL,
  `LastUsed` date DEFAULT NULL,
  `SourceText_id` int(11) DEFAULT NULL,
  `Language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `translationmemory`
--

INSERT INTO `translationmemory` (`Memory_id`, `TargetText`, `LastUsed`, `SourceText_id`, `Language_id`) VALUES
(1, 'Hello', '2024-05-01', 1, 5),
(2, 'In the beginning, God created the heavens and the earth.', '2024-05-01', 2, 4),
(3, 'Hello, my friend!', '2024-05-01', 1, 3),
(4, 'Bonjour à tous !', '2023-04-05', 1, 5),
(5, '¿Cómo estás?', '2024-05-02', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Username` varchar(35) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(35) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Email`, `Password`, `FirstName`, `LastName`, `Gender`) VALUES
('Liza Amina', 'aminaliza@gmail.com', '$2y$10$W8yWZ41L6KNwRG7NTtrjHOhEFQb4', 'Amina', 'Liza', 'male'),
('Rukundo', 'rukundo123@gmail.com', '$2y$10$VvdhtJdgoaOAI4RlXj.Fp.QEw.tS', 'Aimable', 'Rukundo', 'female'),
('DivineIradukunda', 'iradukunda@gmail.com', '$2y$10$DFHNIYVrWIacRaSfAs3Gi.bzSNHf', 'Divine', 'IRADUKUNDA', 'female'),
('aminaliza@gmail.com', 'nsengima@gmail.com', '$2y$10$uzXEPWAA3W/T2iCFDeesBuCatpey', 'Divine', 'IRA', 'male'),
('Agnes Uwamahoro', 'uwamahoro@gmail.com', '$2y$10$4Z1tWTLJO02GTUH38e001uyQFwf6', 'Uwamahoro', 'Agnes', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `userof`
--

CREATE TABLE `userof` (
  `User_id` int(10) NOT NULL,
  `Username` varchar(35) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Password` varchar(35) DEFAULT NULL,
  `Role` varchar(30) DEFAULT NULL,
  `RegistrationDate` date DEFAULT NULL,
  `Lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userof`
--

INSERT INTO `userof` (`User_id`, `Username`, `Email`, `Password`, `Role`, `RegistrationDate`, `Lastlogin`) VALUES
(1, 'Enock Mugisha', 'mugisha@gmail.com', '12345', 'User', '2024-05-02', '2024-05-11 00:00:00'),
(2, 'Aimable Kwizera', 'aimable1@gmail.com', '09876', 'User', '2023-05-04', '2023-06-01 00:00:00'),
(4, 'Akaliza Esther', 'esther234@gmail.com', '1234567890', 'Reviewer', '2024-04-30', '2024-05-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userpreference`
--

CREATE TABLE `userpreference` (
  `Preference_id` int(10) NOT NULL,
  `Theme` varchar(50) DEFAULT NULL,
  `FontSize` varchar(25) DEFAULT NULL,
  `NotificationSetting` varchar(15) DEFAULT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Language_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userpreference`
--

INSERT INTO `userpreference` (`Preference_id`, `Theme`, `FontSize`, `NotificationSetting`, `User_id`, `Language_id`) VALUES
(1, 'Light', 'Medium', 'Enabled', 1, 4),
(2, 'Dark', 'Small', 'Disabled', 2, 3),
(3, 'Light', 'Large', 'Enabled', 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dictionary`
--
ALTER TABLE `dictionary`
  ADD PRIMARY KEY (`Word_id`),
  ADD KEY `Language_id` (`Language_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Feedback_id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `Translation_id` (`Translation_id`);

--
-- Indexes for table `glossary`
--
ALTER TABLE `glossary`
  ADD PRIMARY KEY (`Term_id`),
  ADD KEY `Language_id` (`Language_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`Language_id`);

--
-- Indexes for table `sourcetext`
--
ALTER TABLE `sourcetext`
  ADD PRIMARY KEY (`SourceText_id`);

--
-- Indexes for table `translation`
--
ALTER TABLE `translation`
  ADD PRIMARY KEY (`Translation_id`),
  ADD KEY `SourceText_id` (`SourceText_id`),
  ADD KEY `Language_id` (`Language_id`);

--
-- Indexes for table `translationhistory`
--
ALTER TABLE `translationhistory`
  ADD PRIMARY KEY (`History_id`),
  ADD KEY `Translation_id` (`Translation_id`);

--
-- Indexes for table `translationmemory`
--
ALTER TABLE `translationmemory`
  ADD PRIMARY KEY (`Memory_id`),
  ADD KEY `SourceText_id` (`SourceText_id`),
  ADD KEY `Language_id` (`Language_id`);

--
-- Indexes for table `userof`
--
ALTER TABLE `userof`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `userpreference`
--
ALTER TABLE `userpreference`
  ADD PRIMARY KEY (`Preference_id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `Language_id` (`Language_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dictionary`
--
ALTER TABLE `dictionary`
  MODIFY `Word_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Feedback_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `glossary`
--
ALTER TABLE `glossary`
  MODIFY `Term_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `Language_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sourcetext`
--
ALTER TABLE `sourcetext`
  MODIFY `SourceText_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `translation`
--
ALTER TABLE `translation`
  MODIFY `Translation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `translationhistory`
--
ALTER TABLE `translationhistory`
  MODIFY `History_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `translationmemory`
--
ALTER TABLE `translationmemory`
  MODIFY `Memory_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userof`
--
ALTER TABLE `userof`
  MODIFY `User_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userpreference`
--
ALTER TABLE `userpreference`
  MODIFY `Preference_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dictionary`
--
ALTER TABLE `dictionary`
  ADD CONSTRAINT `dictionary_ibfk_1` FOREIGN KEY (`Language_id`) REFERENCES `language` (`Language_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `userof` (`User_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`Translation_id`) REFERENCES `translation` (`Translation_id`);

--
-- Constraints for table `glossary`
--
ALTER TABLE `glossary`
  ADD CONSTRAINT `glossary_ibfk_1` FOREIGN KEY (`Language_id`) REFERENCES `language` (`Language_id`);

--
-- Constraints for table `translation`
--
ALTER TABLE `translation`
  ADD CONSTRAINT `translation_ibfk_1` FOREIGN KEY (`SourceText_id`) REFERENCES `sourcetext` (`SourceText_id`),
  ADD CONSTRAINT `translation_ibfk_2` FOREIGN KEY (`Language_id`) REFERENCES `language` (`Language_id`);

--
-- Constraints for table `translationhistory`
--
ALTER TABLE `translationhistory`
  ADD CONSTRAINT `translationhistory_ibfk_1` FOREIGN KEY (`Translation_id`) REFERENCES `translation` (`Translation_id`);

--
-- Constraints for table `translationmemory`
--
ALTER TABLE `translationmemory`
  ADD CONSTRAINT `translationmemory_ibfk_1` FOREIGN KEY (`SourceText_id`) REFERENCES `sourcetext` (`SourceText_id`),
  ADD CONSTRAINT `translationmemory_ibfk_2` FOREIGN KEY (`Language_id`) REFERENCES `language` (`Language_id`);

--
-- Constraints for table `userpreference`
--
ALTER TABLE `userpreference`
  ADD CONSTRAINT `userpreference_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `userof` (`User_id`),
  ADD CONSTRAINT `userpreference_ibfk_2` FOREIGN KEY (`Language_id`) REFERENCES `language` (`Language_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
