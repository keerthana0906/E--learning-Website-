-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 12:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `email` text COLLATE utf8mb4_bin NOT NULL,
  `subject` text COLLATE utf8mb4_bin NOT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `subject`, `message`) VALUES
('nkdn', 'jncjskd@nvjknf.com', 'uyi', 'rox on the house');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseid` int(100) NOT NULL,
  `coursename` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `category` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `coursename`, `description`, `category`) VALUES
(1, 'Machine Learning', ' In this class, you will learn about the most effective machine learning techniques, and gain practice implementing them and getting them to work for yourself. More importantly, you will learn about not only the theoretical underpinnings of learning, but also gain the practical know-how needed to quickly and powerfully apply these techniques to new problems. ', 'Computer Science'),
(2, 'Digital Signal Processing', 'Digital Signal Processing begins with a discussion of the analysis and representation of discrete-time signal systems, including discrete-time convolution, difference equations, the z-transform, and the discrete-time Fourier transform. Emphasis is placed on the similarities and distinctions between discrete-time. The course proceeds to cover digital network and nonrecursive  digital filters. Digital Signal Processing concludes with digital filter design and a discussion of the fast Fourier transform algorithm for computation of the discrete Fourier transform.', 'Electronics'),
(3, 'Cryptography', 'Cryptography is an indispensable tool for protecting information in computer systems. In this course you will learn the inner workings of cryptographic systems and how to correctly use them in real-world applications. The course begins with a detailed discussion of how two parties who have a shared secret key can communicate securely when a powerful adversary eavesdrops and tampers with traffic. We will examine many deployed protocols and analyze mistakes in existing systems. ', 'Computer Science'),
(5, 'Database Systems ', 'The purpose of this course is to introduce relational database concepts and help you learn and apply foundational knowledge of the SQL language. It is also intended to get you started with performing SQL access in a data science environment. The emphasis in this course is on hands-on and practical learning . ', 'Computer Science'),
(4, 'Robotics', 'The course introduces you to the concepts of robot flight and movement, how robots perceive their environment, and how they adjust their movements to avoid obstacles, navigate difficult terrains and accomplish complex tasks such as construction and disaster recovery. You will be exposed to real world examples of how robots have been applied in disaster situations, how they have made advances in human health care and what their future capabilities will be. The courses build towards a capstone in which you will learn how to program a robot to perform a variety of movements such as flying and grasping objects.', 'Mechanical, Computer Science, Electronics'),
(6, 'Data Science', 'In this courses learners will develop foundational Data Science skills to prepare them for a career or further learning that involves more advanced topics in Data Science. The specialization entails understanding what is Data Science and the various kinds of activities that a Data Scientist performs. It will familiarize learners with various open source tools, like Jupyter notebooks, used by Data Scientists. It will teach you about methodology involved in tackling data science problems. The specialization also provides knowledge of relational database concepts and the use of SQL to query databases.', 'Computer Science'),
(7, 'Web Development', 'This course covers how to write syntactically correct HTML5 and CSS3, and how to create interactive web experiences with JavaScript. Mastering this range of technologies will allow you to develop high quality web sites that, work seamlessly on mobile, tablet, and large screen browsers accessible. During the capstone you will develop a professional-quality web portfolio demonstrating your growth as a web developer and your knowledge of accessible web design. This will include your ability to design and implement a responsive site that utilizes tools to create a site that is accessible to a wide audience, including those with visual, audial, physical, and cognitive impairments.', 'Computer Science'),
(8, 'Linear Algebra', 'The main goal of the course is to explain the main concepts of linear algebra that are used in data analysis and machine learning. Another goal is to improve the student’s practical skills of using linear algebra methods in machine learning and data analysis. You will learn the fundamentals of working with data in vector and matrix form, acquire skills for solving systems of linear algebraic equations and finding the basic matrix decompositions and general understanding of their applicability', 'Mathematics');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `personid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`personid`, `username`, `password`, `flag`) VALUES
(1, 'harish', 'harish', 0),
(1010, 'admin', 'admin', 1),
(1011, 'sindu', 'sindu', 0),
(1012, 'fefv', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `courseid` int(100) NOT NULL,
  `personid` int(100) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `personid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `college` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`personid`, `name`, `email`, `college`) VALUES
(0, 'shanjeev', 'sdff@gmail.com', 'iiitdm'),
(0, 'shanjeev', 'fdwsdf@hu.com', 'iiitdm'),
(0, 'harish', 'harish@gmail', 'iiit'),
(0, 'harish', 'harish@gmail', 'iiit'),
(1, 'harish', 'harish@gmail', 'iiit'),
(1011, 'sindu', 'sindu', 'sindu'),
(1012, 'fefv', 'qwe', 'edrfer@hmsil.com');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `courseid` int(100) NOT NULL,
  `part` int(50) NOT NULL,
  `vidsrc` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`courseid`, `part`, `vidsrc`) VALUES
(1, 1, 'uploads/1_1.mp4'),
(1, 2, 'uploads/1_2.mp4'),
(1, 3, 'uploads/1_3.mp4'),
(2, 1, 'uploads/2_1.mp4'),
(2, 2, 'uploads/2_2.mp4'),
(2, 3, 'uploads/2_3.mp4'),
(3, 1, 'uploads/3_1.mp4'),
(3, 2, 'uploads/3_2.mp4'),
(4, 1, 'uploads/4_1.mp4'),
(4, 2, 'uploads/4_2.mp4'),
(5, 1, 'uploads/5_1.mp4'),
(5, 2, 'uploads/5_2.mp4'),
(6, 1, 'uploads/6_1.mp4'),
(6, 2, 'uploads/6_2.mp4'),
(6, 3, 'uploads/6_3.mp4'),
(7, 1, 'uploads/7_1.mp4'),
(7, 2, 'uploads/7_2.mp4'),
(7, 3, 'uploads/7_3.mp4'),
(8, 1, 'uploads/8_1.mp4'),
(8, 2, 'uploads/8_2.mp4'),
(8, 3, 'uploads/8_3.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`personid`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `personid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
