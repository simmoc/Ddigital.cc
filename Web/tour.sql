-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2017 at 09:56 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicationstatus`
--

CREATE TABLE `applicationstatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `tour_application_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `applicationstatus`
--

INSERT INTO `applicationstatus` (`id`, `tour_application_id`, `status`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'submitted', 2, '2017-01-25 22:44:19', '2017-01-25 22:44:19'),
(2, 2, 'submitted', 2, '2017-01-25 23:10:35', '2017-01-25 23:10:35'),
(3, 1, 'moved_to_finance_manager', 4, '2017-01-25 23:11:15', '2017-01-25 23:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_01_24_011903_entrust_setup_tables', 2),
(4, '2017_01_25_233552_create_tourapplication_table', 3),
(5, '2017_01_26_035735_create_applicationstatus_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin role', '2017-01-23 20:03:44', '2017-01-23 20:03:44'),
(2, 'manager', 'Manager', NULL, '2017-01-25 11:50:42', '2017-01-25 11:52:01'),
(3, 'employee', 'Employee', NULL, '2017-01-25 11:52:52', '2017-01-25 11:52:52'),
(4, 'finance_manager', 'Finance Manager', NULL, '2017-01-25 18:01:57', '2017-01-25 18:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(4, 2),
(5, 3),
(6, 3),
(7, 1),
(8, 3),
(9, 2),
(10, 2),
(11, 4),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tourapplications`
--

CREATE TABLE `tourapplications` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `travel_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_cost` decimal(10,2) NOT NULL,
  `cab_cost_home` decimal(10,2) NOT NULL,
  `cab_cost_destination` decimal(10,2) NOT NULL,
  `hotel_cost` decimal(10,2) NOT NULL,
  `manager_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('draft','submitted','approved','rejected','request_for_information','moved_to_finance_manager') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `submitted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tourapplications`
--

INSERT INTO `tourapplications` (`id`, `title`, `slug`, `description`, `start_date`, `end_date`, `travel_mode`, `ticket_cost`, `cab_cost_home`, `cab_cost_destination`, `hotel_cost`, `manager_id`, `status`, `submitted_by`, `created_at`, `updated_at`) VALUES
(1, 'First Travel', 'first-travel', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words ', '2017-01-01', '2017-01-03', 'Flight', '600.00', '50.00', '200.00', '800.00', 4, 'moved_to_finance_manager', 2, '2017-01-25 20:19:44', '2017-01-25 23:11:15'),
(2, 'Second Travel', 'second-travel', 'This is my second travel to the same place', '2017-01-22', '2017-01-28', 'Train', '300.00', '123.00', '222.00', '455.00', 4, 'submitted', 2, '2017-01-25 22:46:34', '2017-01-25 23:10:35'),
(3, 'Third Tour', 'third-tour', 'This is my third tour', '2017-01-30', '2017-02-05', 'Bus', '200.00', '122.00', '44.00', '245.00', 4, 'draft', 2, '2017-01-25 23:09:41', '2017-01-25 23:09:41'),
(4, 'Test', 'test', 'test afdf sfsfdf', '2017-01-04', '2017-01-20', 'dddd', '1212.00', '1212.00', '4444.00', '111.00', 9, 'draft', 12, '2017-01-26 02:09:06', '2017-01-26 02:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `slug`, `email`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Vamsi', NULL, 'vamsi@vamsi.com', '$2y$10$F02657Gnb7fThxE1uI/uAuGJguLsMWooYwBMh.ZLFwJO9TYryDtKa', 1, 'a11J3ZlWXxri2LfRy88sLvbiaDECaIhh5RubCfX5drUBZoTZTCUNuifcyJUH', '2017-01-23 19:15:08', '2017-01-26 03:25:49'),
(2, 'John', 'john', 'john@john.com', '$2y$10$RMQ2lHb8cqZTXplD2Meo0utUhuy0cuz/Cv0ufac6ZI6Q.wwpSXkE2', 3, 'eeWSoAhGn9SRUPc3uC9UL6PzpOd1d7t5EB2CJNT1JSIG1i7PfPhvAlR0Hvp2', '2017-01-25 12:28:17', '2017-01-26 01:12:16'),
(4, 'Raj', 'raj', 'raj@raj.com', '$2y$10$7FVBke6QVwC6Q/XSQv2etOs5ZBh5qy00UwN8I8.ZYeWfu8TWH.Nzq', 2, '6ETAT1v6W7YBPL3kfnGC62u8AepqQe3bQxlX4vnJfItNyhYVpxAEGx0pVMlp', '2017-01-25 12:32:39', '2017-01-26 02:32:45'),
(5, 'Krish', 'krish', 'krish@krish.com', '$2y$10$h9B8CUasJwZcc1ZBNsDTwe7v1t7kYie4M94p3J.TRTdybF0/rIsaC', 3, NULL, '2017-01-25 12:34:50', '2017-01-25 12:34:50'),
(6, 'Rajesh', 'rajesh', 'rajesh@rajesh.com', '$2y$10$EN9ul3Um2llQjH6O1HKLfOsLs6vPxihYN7U8ZUrfUKX9KU.crjB8a', 3, NULL, '2017-01-25 12:36:01', '2017-01-25 12:36:01'),
(7, 'Jarvis', 'jarvis', 'jarvis@jarvis.com', '$2y$10$9DsQqKM0PaxRMkbnKXd3I./clN9q2PBETvC752d89fOGNK7ELSlku', 1, NULL, '2017-01-25 12:37:31', '2017-01-25 12:37:31'),
(8, 'Rajan', 'rajan', 'rajan@rajan.com', '$2y$10$Kc5vWuGxLsLze80yMtL22eNJ92Xurv77T8pVV17nAL6nKrxZ9NkJm', 3, NULL, '2017-01-25 12:51:46', '2017-01-25 12:51:46'),
(9, 'Manager2', 'manager2', 'manager2@manager2.com', '$2y$10$Oe2Mq0CPvUKn6POPpjIg5OJe6dnyEdXTXWr4S4HevbrG9ag1hWGkW', 2, NULL, '2017-01-25 18:02:53', '2017-01-25 18:02:53'),
(10, 'Manager3', 'manager3', 'manager3@manager3.com', '$2y$10$zu3yzzBjwSUfWrvyM3Q9t.nUW9ZpTjZJp1qlj3W9fyt2BFxnZ/95.', 2, NULL, '2017-01-25 18:03:14', '2017-01-25 18:03:14'),
(11, 'Finance Manager', 'finance-manager', 'financemanager@financemanager.com', '$2y$10$KvjGo4bRRDhg4Z8DHCJEuelxqGX7KwEOwjIMiN1UL3erRdv3qe0em', 4, 'cPdArs3Oy7cpdSPSDTAcNMwJAAxJABdRilLayYAqYxi0TZCd4HrfekpbclZE', '2017-01-25 18:03:40', '2017-01-26 03:23:54'),
(12, 'JUTTIGA SAIGOWTHAM', 'juttiga-saigowtham', 'gauthom@gautham.com', '$2y$10$bGnZIuht7Ngln/ZYrb7a3.JZlcs/d1lgw7MnXR/gjUpVLjtM00Rdi', 3, NULL, '2017-01-26 01:04:13', '2017-01-26 01:04:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicationstatus`
--
ALTER TABLE `applicationstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `tourapplications`
--
ALTER TABLE `tourapplications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicationstatus`
--
ALTER TABLE `applicationstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tourapplications`
--
ALTER TABLE `tourapplications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tourapplications`
--
ALTER TABLE `tourapplications`
  ADD CONSTRAINT `tourapplications_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
