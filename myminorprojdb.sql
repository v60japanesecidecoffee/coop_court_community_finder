-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 10:59 AM
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
-- Database: `myminorprojdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountdata`
--

CREATE TABLE `accountdata` (
  `SID` int(11) NOT NULL,
  `S_Firstname` varchar(255) NOT NULL,
  `S_Lastname` varchar(255) NOT NULL,
  `S_Email` varchar(255) NOT NULL,
  `S_Username` varchar(255) NOT NULL,
  `S_Password` varchar(255) NOT NULL,
  `S_ProfileIMG` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountdata`
--

INSERT INTO `accountdata` (`SID`, `S_Firstname`, `S_Lastname`, `S_Email`, `S_Username`, `S_Password`, `S_ProfileIMG`) VALUES
(3, 'Charles', 'Leclerc', 'cl16@f1.com', 'monacogp', 'winner', 'https://e1.365dm.com/f1/drivers/256x256/h_full_1489.png'),
(4, 'Anthony', 'Ginting', 'anthony@yahoo.com', 'TingMan123', 'mensinglesindonesia', 'https://pbs.twimg.com/profile_images/738611149831180292/h8WZ3oUM_400x400.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `skill_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `name`, `description`, `skill_level`) VALUES
(1, 'Tangkas Men\'s Community', 'For men to grow as individuals, open to all men of all ages, we play in singles and doubles', 'Advanced'),
(2, 'Super Shuttle', 'For intermediate players looking for friends to play with, we play doubles, accepting members of all genders, age range teen to adults', 'Intermediate'),
(3, 'Fun Feather', 'For beginners, all ages', 'Beginner'),
(4, 'PB Djarum Community', 'Based in Central Java, but we have sub-groups all over the world. Playing at the highest level of badminton.', 'Semi-Professional'),
(5, 'Sejong Badminton Club', 'For Sejong University students only. All playing levels are welcome!', 'Any');

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `imgurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`id`, `name`, `location`, `description`, `imgurl`) VALUES
(1, 'Gwangjang-dong Indoor Badminton Court', '140gil 40 Cheonhodaero, Gwangjin-gu, Seoul, KOREA', 'A popular outdoor badminton court located in Gwangjin-gu, often visited by both locals, most visitors here are beginners, offers lessons for adults and children.', 'https://www.expatkidskorea.com/media/cache/small/custom/domain_1/image_files/sitemgr_photo_11349.png'),
(2, 'Seongbuk-gu Municipal Wolgok Badminton Court', '산2-86 월곡제1동 Seongbuk District, Seoul', 'High maintenance, great service, uses rubber courts instead of wood', 'https://cdn.imweb.me/thumbnail/20191118/18314b2804a47.jpg'),
(3, 'Sanseong Indoor Badminton Court', '38-2, Jung-dong, Bucheon-si, Gyeonggi-do', 'A local favorite indoor badminton court. The facility has 6 courts.', 'https://lh3.googleusercontent.com/p/AF1QipMQPMK3PS6Ljs0JS9GIi99u6KNw75wYoU3kZ2jY=s1360-w1360-h1020'),
(4, 'Tangkas Sports Centre', 'Komplek Greenville, Jl. Tj. Duren Barat, RT.11/RW.9, Duri Kepa, Kebonjeruk, West Jakarta City, Jakarta 11510, Indonesia', 'Has the best court quality and lighting. Used by all players of all skill levels.', 'https://i.ytimg.com/vi/DQzPEeZvjc0/maxresdefault.jpg'),
(5, 'PBSI Garuda Badminton', 'Jl. Perdana Kusuma Blok Qq No.248AB, RT.1/RW.4, Wijaya Kusuma, Kec. Grogol petamburan, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11460, Indonesia', 'High quality badminton court. Has little badminton store that meets all your badminton needs. A lot of history.', 'https://fastly.4sqi.net/img/general/600x600/53479829_SmiNEdTzeW14_Gz1KiIiJhAlpLn-p4qCFumNNThLs5s.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `review_id` int(11) DEFAULT NULL,
  `user_ip` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `review_id`, `user_ip`) VALUES
(2, 2, '::1'),
(4, 4, '::1'),
(5, 5, '::1'),
(6, 6, '::1'),
(36, 8, '::1'),
(39, 16, '::1'),
(40, 17, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `community_id`, `name`, `email`) VALUES
(1, 1, 'Jonatan', 'jonatan@tangkas.co.id'),
(2, 1, 'Anthony Ginting', 'anthony@gmail.com'),
(3, 2, 'Carlos Sainz', 'smooth@operator.com'),
(4, 3, 'Sebastian', 'vettel@rb.com'),
(5, 2, 'Max Verstappen', 'max@rb.com'),
(6, 2, 'Fernando Alonso', 'alonsofernando@aston.martin'),
(7, 3, 'Kimi', 'ice@gmail.com'),
(8, 1, 'Alwi Farhan', 'alw.frhn79@gmail.com'),
(9, 3, 'Nico Rosberg', 'brocedes2@benz.com'),
(10, 4, 'Reino', 'email@email.com'),
(11, 5, 'Hanni Pham', 'hanni@nj.co.kr');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `court_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `reviewer_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `court_id`, `rating`, `comment`, `reviewer_name`) VALUES
(1, 1, 4, 'Clean court and bathrooms. The instructors were friendly and helpful. Other students were friendly as well. :D', 'Gregoria'),
(2, 1, 4, 'Great place to learn badminton. The instructors are friendly and helpful. The environment is beginner-friendly, and the lessons are well-structured.', 'Jane Doe'),
(3, 1, 4, 'Cup!', 'Thomas'),
(4, 1, 4, 'Cup!', 'Thomas'),
(5, 1, 1, 'Booooo', 'John'),
(6, 1, 3, 'Verstappen', 'Max'),
(7, 1, 5, 'oh really?????', 'charles'),
(8, 1, 2, 'bomboclat', 'Padang'),
(9, 2, 5, 'Good!', 'Kim'),
(10, 2, 4, 'Super!', 'Park'),
(11, 2, 5, 'Nice!', 'Hwang'),
(12, 2, 5, 'Yong-dae', 'Lee'),
(13, 3, 2, 'Slippery court :(', 'Kwak'),
(14, 3, 5, 'Love it!', 'Beom'),
(15, 3, 1, 'Never going back!', 'Kwang'),
(16, 4, 5, 'mantap!', 'Jonatan'),
(17, 4, 4, 'oke lah', 'hadinata'),
(18, 5, 5, 'Awesome!', 'Edi'),
(19, 2, 1, 'a', 'A'),
(20, 4, 5, 'ANJAY!!!', 'Joseph');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountdata`
--
ALTER TABLE `accountdata`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `community_id` (`community_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `court_id` (`court_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountdata`
--
ALTER TABLE `accountdata`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`community_id`) REFERENCES `communities` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`court_id`) REFERENCES `courts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
