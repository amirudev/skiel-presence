-- auto-generated definition
create schema `presenskiel-db` collate utf8mb4_general_ci;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `username` VARCHAR(50),
                        `email` TEXT,
                        `password` VARCHAR(255),
                        `phone` VARCHAR(50),
                        `role` VARCHAR(50),
                        `teacher_id` INT(11) NULL,
                        `student_id` INT(11) NULL,
                        `admin_id` INT(11) NULL,
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `name` VARCHAR(50),
                        `phone` VARCHAR(50),
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-05-01 00:00:00', '2020-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `name` VARCHAR(50),
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'teacher', '2020-05-01 00:00:00', '2020-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `name` VARCHAR(50),
                        `role` VARCHAR(50),
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'student', 'head', '2020-05-01 00:00:00', '2020-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `name` VARCHAR(50),
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'class', '2020-05-01 00:00:00', '2020-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE `class_student` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `class_id` INT(11),
                        `student_id` INT(11),
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`id`, `class_id`, `student_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2020-05-01 00:00:00', '2020-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `class_id` INT(11),
                        `teacher_id` INT(11),
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_teacher`
--

INSERT INTO `class_teacher` (`id`, `class_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2020-05-01 00:00:00', '2020-05-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `presence_user`
--

CREATE TABLE `presence_user` (
                        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        `user_id` INT(11),
                        `timestart` TIMESTAMP NULL,
                        `timeend` TIMESTAMP NULL,
                        `location` VARCHAR(50),
                        `status` VARCHAR(50),
                        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `presence_user`
--

INSERT INTO `presence_user` (`id`, `user_id`, `timestart`, `timeend`, `location`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '2020-05-01 00:00:00', '2020-05-01 00:00:00', 'location', 'status', '2020-05-01 00:00:00', '2020-05-01 00:00:00');

-- --------------------------------------------------------