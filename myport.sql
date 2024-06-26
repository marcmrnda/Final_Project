-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 12:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myport`
--

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `education_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `preschool_name` varchar(255) NOT NULL,
  `preschool_year` varchar(255) NOT NULL,
  `preschool_desc` varchar(255) NOT NULL,
  `gradeSchool_name` varchar(255) NOT NULL,
  `gradeSchool_year` varchar(255) NOT NULL,
  `gradeSchool_desc` varchar(255) NOT NULL,
  `Jhighschool_name` varchar(255) NOT NULL,
  `Jhighschool_year` varchar(255) NOT NULL,
  `Jhighschool_desc` varchar(255) NOT NULL,
  `Shighschool_name` varchar(255) NOT NULL,
  `Shighschool_year` varchar(255) NOT NULL,
  `Shighschool_desc` varchar(255) NOT NULL,
  `University_name` varchar(255) NOT NULL,
  `College_year` varchar(255) NOT NULL,
  `University_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`education_id`, `user_id`, `preschool_name`, `preschool_year`, `preschool_desc`, `gradeSchool_name`, `gradeSchool_year`, `gradeSchool_desc`, `Jhighschool_name`, `Jhighschool_year`, `Jhighschool_desc`, `Shighschool_name`, `Shighschool_year`, `Shighschool_desc`, `University_name`, `College_year`, `University_desc`) VALUES
(8, 34, 'America', '1980-1981', 'I viewed these early years as foundational, building essential skills and forming his initial understanding of the world', 'America2', '1981-1987', 'I remember these times as when he developed his love for physical activity and sports, which later played a significant role in his wrestling career', 'Central Catholic High School', '1987-1991', 'I become more aware of his interests and talents, particularly in sports and fitness', 'Cushing Academy', '1991-1993', 'I was known to be very athletic, playing football and other sports. These years probably helped shape his discipline and work ethic, crucial traits for his future endeavors in wrestling and acting', 'SpringField College', '1993-1997', 'I view this college years as a critical period for his personal and professional development. His education in exercise physiology directly contributed to his understanding of physical fitness, which is essential for his career in wrestling and entertainm'),
(9, 35, 'Puso ni Jesus Schools', '2007-2008', 'Its a great experience for a kid like me', 'Puso ni Jesus School & Lipa City Colleges Silvercrest', '2009-2014', '2 schools is tough but I like the climate here at Lipa', 'Lipa City Colleges Silvercrest & APEC Schools Lipa', '2015-2019', 'Another 2 Schools, I left friends behind but met a better one a family', 'APEC Schools Lipa', '2019-2021', 'Pandemic Era, Its bad but we have no choice', 'University of Batangas Lipa & National University Lipa', '2021-Present', 'Being a college students sucks but in the end its a great learning experience and such great and mature friends met on the way to success');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `home_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_fullName` varchar(255) NOT NULL,
  `user_desc` text NOT NULL,
  `user_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`home_id`, `user_id`, `user_fullName`, `user_desc`, `user_pic`) VALUES
(6, 34, 'John Cena', 'I am a American professional wrestler, actor, and television presenter. He gained fame as a WWE superstar, known for his ', ''),
(7, 35, 'Marc Miranda', 'Hi, My name is Marc Miranda an Aspiring Student that wants to grow in the Technology Field, In my Portfolio you will dive into the minds and works of a Second Year Student from NU Lipa Enjoy!', 'uploads/c53b455675c5663c8a1c5ec5f5e9d110_1719430899.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `links_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `X_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `github_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`links_id`, `user_id`, `facebook_link`, `X_link`, `instagram_link`, `github_link`) VALUES
(10, 34, 'https://www.facebook.com/johncena/', 'https://x.com/JohnCena', 'https://www.instagram.com/johncena/', 'https://www.wwe.com/superstars/john-cena'),
(11, 35, 'https://www.facebook.com/marclouisse.miranda', 'https://x.com/Mirandowgz', 'https://www.instagram.com/miranda_marc/', 'https://github.com/marcmrnda');

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE `occupation` (
  `occupation_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `occupation_name1` varchar(255) NOT NULL,
  `occupation_name2` varchar(255) NOT NULL,
  `occupation_name3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`occupation_id`, `user_id`, `occupation_name1`, `occupation_name2`, `occupation_name3`) VALUES
(1, 34, 'Wrestler', 'Actor', 'Advocate'),
(2, 35, 'NUL Students', 'Future Developer', 'Future Cyborg');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projects_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_desc` text NOT NULL,
  `project_link` varchar(255) NOT NULL,
  `project_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projects_id`, `user_id`, `project_name`, `project_desc`, `project_link`, `project_pic`) VALUES
(15, 34, 'Peacemake', 'Picking up where The Suicide Squad (2021) left off, Peacemaker returns home after recovering from his encounter with Bloodsport - only to discover that his freedom comes at a price.', 'https://www.imdb.com/title/tt13146488/', 'uploads/peacemaker-doves-1633429811873_1719398527.jpg'),
(16, 35, 'LAYAssss', 'It is an AI Law Assistant that will help citizen to really understand how the Philippine Law works', 'https://github.com/iNUvators/LAYA', 'uploads/Copy of iSHARE - PSC (1)_1719437400.png'),
(26, 34, 'Peacemake', 'Picking up where The Suicide Squad (2021) left off, Peacemaker returns home after recovering from his encounter with Bloodsport - only to discover that his freedom comes at a price.', 'https://www.imdb.com/title/tt13146488/', 'uploads/OIP.jpg'),
(27, 35, 'ISHARE', 'Booking site for Working Students', 'https://github.com/iNUvators/LAYA', 'uploads/Copy of iSHARE - PSC_1719436590.png');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skills_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `skills_name` varchar(255) NOT NULL,
  `skills_percentage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skills_id`, `user_id`, `skills_name`, `skills_percentage`) VALUES
(10, 34, 'Wrestling', 100),
(11, 35, 'SQL', 90),
(12, 34, 'Acting', 70);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `account_type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `account_type`) VALUES
(34, 'ucantseeme25', 'johncena@gmail.com', '$2y$10$5cDNaXvNNbKVY8Gn1vS3TupLe0inOyubNY5oT/FejDY0MpkTlqDe.', 1),
(35, 'marcmrnda', 'marcmrnda@gmail.com', '$2y$10$RQ7w3rj5K20DjwcwjcBTKO9BieYqCBI7W2reCwEScskb9vcgOzpIS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`home_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`links_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`occupation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projects_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skills_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `home_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `links_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `occupation_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projects_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skills_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `home`
--
ALTER TABLE `home`
  ADD CONSTRAINT `home_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `occupation`
--
ALTER TABLE `occupation`
  ADD CONSTRAINT `occupation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
