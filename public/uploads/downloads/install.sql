-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2017 at 08:44 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmdemola_digi_downloads`
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
(1, 1, 'submitted', 2, '2017-01-26 04:14:19', '2017-01-26 04:14:19'),
(2, 2, 'submitted', 2, '2017-01-26 04:40:35', '2017-01-26 04:40:35'),
(3, 1, 'moved_to_finance_manager', 4, '2017-01-26 04:41:15', '2017-01-26 04:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `meta_tag_title` text COLLATE utf8_unicode_ci,
  `meta_tag_description` text COLLATE utf8_unicode_ci,
  `meta_tag_keywords` text COLLATE utf8_unicode_ci,
  `parent_id` bigint(20) DEFAULT '0',
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `sort_order` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `record_updated_by` int(11) DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories_empty`
--

CREATE TABLE `categories_empty` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_tag_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_tag_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_tag_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `seo_keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `show_in_menu` tinyint(4) NOT NULL,
  `columns` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id_countries` int(3) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `iso_alpha2` varchar(2) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `iso_alpha3` varchar(3) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `iso_numeric` int(11) DEFAULT NULL,
  `currency_code` char(3) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `currency_name` varchar(32) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `currency_symbol` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `phonecode` int(6) DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_520_ci DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id_countries`, `name`, `iso_alpha2`, `iso_alpha3`, `iso_numeric`, `currency_code`, `currency_name`, `currency_symbol`, `flag`, `phonecode`, `status`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 4, 'AFN', 'Afghani', '&#x60b;', 'AF.png', 93, 'Active'),
(2, 'Albania', 'AL', 'ALB', 8, 'ALL', 'Lek', 'L', 'AL.png', 355, 'Active'),
(3, 'Algeria', 'DZ', 'DZA', 12, 'DZD', 'Dinar', '&#x62f;.&#x62c;', 'DZ.png', 213, 'Active'),
(4, 'American Samoa', 'AS', 'ASM', 16, 'USD', 'Dollar', '&#36;', 'AS.png', 1684, 'Active'),
(5, 'Andorra', 'AD', 'AND', 20, 'EUR', 'Euro', '&euro;', 'AD.png', 376, 'Active'),
(6, 'Angola', 'AO', 'AGO', 24, 'AOA', 'Kwanza', 'Kz', 'AO.png', 244, 'Active'),
(7, 'Anguilla', 'AI', 'AIA', 660, 'XCD', 'Dollar', '&#36;', 'AI.png', 1264, 'Active'),
(8, 'Antarctica', 'AQ', 'ATA', 10, '', '', NULL, 'AQ.png', NULL, 'Active'),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 28, 'XCD', 'Dollar', '&#36;', 'AG.png', 1268, 'Active'),
(10, 'Argentina', 'AR', 'ARG', 32, 'ARS', 'Peso', '&#36;', 'AR.png', 54, 'Active'),
(11, 'Armenia', 'AM', 'ARM', 51, 'AMD', 'Dram', '&#1423;', 'AM.png', 374, 'Active'),
(12, 'Aruba', 'AW', 'ABW', 533, 'AWG', 'Guilder', '&fnof;', 'AW.png', 297, 'Active'),
(13, 'Australia', 'AU', 'AUS', 36, 'AUD', 'Dollar', '&#36;', 'AU.png', 61, 'Active'),
(14, 'Austria', 'AT', 'AUT', 40, 'EUR', 'Euro', '&euro;', 'AT.png', 43, 'Active'),
(15, 'Azerbaijan', 'AZ', 'AZE', 31, 'AZN', 'Manat', '&#8380;', 'AZ.png', 994, 'Active'),
(16, 'Bahamas', 'BS', 'BHS', 44, 'BSD', 'Dollar', '&#36;', 'BS.png', 1242, 'Active'),
(17, 'Bahrain', 'BH', 'BHR', 48, 'BHD', 'Dinar', '.&#x62f;.&#x628;', 'BH.png', 973, 'Active'),
(18, 'Bangladesh', 'BD', 'BGD', 50, 'BDT', 'Taka', '&#2547;&nbsp;', 'BD.png', 880, 'Active'),
(19, 'Barbados', 'BB', 'BRB', 52, 'BBD', 'Dollar', '&#36;', 'BB.png', 1246, 'Active'),
(20, 'Belarus', 'BY', 'BLR', 112, 'BYR', 'Ruble', '&#41015;', 'BY.png', 375, 'Active'),
(21, 'Belgium', 'BE', 'BEL', 56, 'EUR', 'Euro', '&euro;', 'BE.png', 32, 'Active'),
(22, 'Belize', 'BZ', 'BLZ', 84, 'BZD', 'Dollar', '&#36;', 'BZ.png', 501, 'Active'),
(23, 'Benin', 'BJ', 'BEN', 204, 'XOF', 'Franc', 'Fr', 'BJ.png', 229, 'Active'),
(24, 'Bermuda', 'BM', 'BMU', 60, 'BMD', 'Dollar', '&#36;', 'BM.png', 1441, 'Active'),
(25, 'Bhutan', 'BT', 'BTN', 64, 'BTN', 'Ngultrum', 'Nu.', 'BT.png', 975, 'Active'),
(26, 'Bolivia', 'BO', 'BOL', 68, 'BOB', 'Boliviano', 'Bs.', 'BO.png', 591, 'Active'),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', 70, 'BAM', 'Marka', 'KM', 'BA.png', 387, 'Active'),
(28, 'Botswana', 'BW', 'BWA', 72, 'BWP', 'Pula', 'P', 'BW.png', 267, 'Active'),
(29, 'Bouvet Island', 'BV', 'BVT', 74, 'NOK', 'Krone', '&#107;&#114;', 'BV.png', NULL, 'Active'),
(30, 'Brazil', 'BR', 'BRA', 76, 'BRL', 'Real', '&#82;&#36;', 'BR.png', 55, 'Active'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 86, 'USD', 'Dollar', '&#36;', 'IO.png', NULL, 'Active'),
(32, 'British Virgin Islands', 'VG', 'VGB', 92, 'USD', 'Dollar', '&#36;', 'VG.png', 1284, 'Active'),
(33, 'Brunei', 'BN', 'BRN', 96, 'BND', 'Dollar', '&#36;', 'BN.png', 673, 'Active'),
(34, 'Bulgaria', 'BG', 'BGR', 100, 'BGN', 'Lev', '&#1083;&#1074;.', 'BG.png', 359, 'Active'),
(35, 'Burkina Faso', 'BF', 'BFA', 854, 'XOF', 'Franc', 'Fr', 'BF.png', 226, 'Active'),
(36, 'Burundi', 'BI', 'BDI', 108, 'BIF', 'Franc', 'Fr', 'BI.png', 257, 'Active'),
(37, 'Cambodia', 'KH', 'KHM', 116, 'KHR', 'Riels', '&#x17db;', 'KH.png', 855, 'Active'),
(38, 'Cameroon', 'CM', 'CMR', 120, 'XAF', 'Franc', 'Fr', 'CM.png', 237, 'Active'),
(39, 'Canada', 'CA', 'CAN', 124, 'CAD', 'Dollar', '&#36;', 'CA.png', 1, 'Active'),
(40, 'Cape Verde', 'CV', 'CPV', 132, 'CVE', 'Escudo', '&#36;', 'CV.png', 238, 'Active'),
(41, 'Cayman Islands', 'KY', 'CYM', 136, 'KYD', 'Dollar', '&#36;', 'KY.png', 1345, 'Active'),
(42, 'Central African Republic', 'CF', 'CAF', 140, 'XAF', 'Franc', 'Fr', 'CF.png', 236, 'Active'),
(43, 'Chad', 'TD', 'TCD', 148, 'XAF', 'Franc', 'Fr', 'TD.png', 235, 'Active'),
(44, 'Chile', 'CL', 'CHL', 152, 'CLP', 'Peso', '&#36;', 'CL.png', 56, 'Active'),
(45, 'China', 'CN', 'CHN', 156, 'CNY', 'Yuan Renminbi', '&yen;', 'CN.png', 86, 'Active'),
(46, 'Christmas Island', 'CX', 'CXR', 162, 'AUD', 'Dollar', '&#36;', 'CX.png', NULL, 'Active'),
(47, 'Cocos Islands', 'CC', 'CCK', 166, 'AUD', 'Dollar', '&#36;', 'CC.png', NULL, 'Active'),
(48, 'Colombia', 'CO', 'COL', 170, 'COP', 'Peso', '&#36;', 'CO.png', 57, 'Active'),
(49, 'Comoros', 'KM', 'COM', 174, 'KMF', 'Franc', 'Fr', 'KM.png', 269, 'Active'),
(50, 'Cook Islands', 'CK', 'COK', 184, 'NZD', 'Dollar', '&#36;', 'CK.png', 682, 'Active'),
(51, 'Costa Rica', 'CR', 'CRI', 188, 'CRC', 'Colon', '&#x20a1;', 'CR.png', 506, 'Active'),
(52, 'Croatia', 'HR', 'HRV', 191, 'HRK', 'Kuna', 'Kn', 'HR.png', 385, 'Active'),
(53, 'Cuba', 'CU', 'CUB', 192, 'CUP', 'Peso', '&#36;', 'CU.png', 53, 'Active'),
(54, 'Cyprus', 'CY', 'CYP', 196, 'CYP', 'Pound', NULL, 'CY.png', 357, 'Active'),
(55, 'Czech Republic', 'CZ', 'CZE', 203, 'CZK', 'Koruna', '&#75;&#269;', 'CZ.png', 420, 'Active'),
(56, 'Democratic Republic of the Congo', 'CD', 'COD', 180, 'CDF', 'Franc', 'Fr', 'CD.png', 242, 'Active'),
(57, 'Denmark', 'DK', 'DNK', 208, 'DKK', 'Krone', 'DKK', 'DK.png', 45, 'Active'),
(58, 'Djibouti', 'DJ', 'DJI', 262, 'DJF', 'Franc', 'Fr', 'DJ.png', 253, 'Active'),
(59, 'Dominica', 'DM', 'DMA', 212, 'XCD', 'Dollar', '&#36;', 'DM.png', 1767, 'Active'),
(60, 'Dominican Republic', 'DO', 'DOM', 214, 'DOP', 'Peso', 'RD&#36;', 'DO.png', 1809, 'Active'),
(61, 'East Timor', 'TL', 'TLS', 626, 'USD', 'Dollar', '&#36;', 'TL.png', NULL, 'Active'),
(62, 'Ecuador', 'EC', 'ECU', 218, 'USD', 'Dollar', '&#36;', 'EC.png', 593, 'Active'),
(63, 'Egypt', 'EG', 'EGY', 818, 'EGP', 'Pound', 'EGP', 'EG.png', 20, 'Active'),
(64, 'El Salvador', 'SV', 'SLV', 222, 'SVC', 'Colone', NULL, 'SV.png', 503, 'Active'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 226, 'XAF', 'Franc', 'Fr', 'GQ.png', 240, 'Active'),
(66, 'Eritrea', 'ER', 'ERI', 232, 'ERN', 'Nakfa', 'Nfk', 'ER.png', 291, 'Active'),
(67, 'Estonia', 'EE', 'EST', 233, 'EEK', 'Kroon', NULL, 'EE.png', 372, 'Active'),
(68, 'Ethiopia', 'ET', 'ETH', 231, 'ETB', 'Birr', 'Br', 'ET.png', 251, 'Active'),
(69, 'Falkland Islands', 'FK', 'FLK', 238, 'FKP', 'Pound', '&pound;', 'FK.png', 500, 'Active'),
(70, 'Faroe Islands', 'FO', 'FRO', 234, 'DKK', 'Krone', 'DKK', 'FO.png', 298, 'Active'),
(71, 'Fiji', 'FJ', 'FJI', 242, 'FJD', 'Dollar', '&#36;', 'FJ.png', 679, 'Active'),
(72, 'Finland', 'FI', 'FIN', 246, 'EUR', 'Euro', '&euro;', 'FI.png', 358, 'Active'),
(73, 'France', 'FR', 'FRA', 250, 'EUR', 'Euro', '&euro;', 'FR.png', 33, 'Active'),
(74, 'French Guiana', 'GF', 'GUF', 254, 'EUR', 'Euro', '&euro;', 'GF.png', 594, 'Active'),
(75, 'French Polynesia', 'PF', 'PYF', 258, 'XPF', 'Franc', 'Fr', 'PF.png', 689, 'Active'),
(76, 'French Southern Territories', 'TF', 'ATF', 260, 'EUR', 'Euro  ', '&euro;', 'TF.png', NULL, 'Active'),
(77, 'Gabon', 'GA', 'GAB', 266, 'XAF', 'Franc', 'Fr', 'GA.png', 241, 'Active'),
(78, 'Gambia', 'GM', 'GMB', 270, 'GMD', 'Dalasi', 'D', 'GM.png', 220, 'Active'),
(79, 'Georgia', 'GE', 'GEO', 268, 'GEL', 'Lari', '&#x10da;', 'GE.png', 995, 'Active'),
(80, 'Germany', 'DE', 'DEU', 276, 'EUR', 'Euro', '&euro;', 'DE.png', 49, 'Active'),
(81, 'Ghana', 'GH', 'GHA', 288, 'GHC', 'Cedi', NULL, 'GH.png', 233, 'Active'),
(82, 'Gibraltar', 'GI', 'GIB', 292, 'GIP', 'Pound', '&pound;', 'GI.png', 350, 'Active'),
(83, 'Greece', 'GR', 'GRC', 300, 'EUR', 'Euro', '&euro;', 'GR.png', 30, 'Active'),
(84, 'Greenland', 'GL', 'GRL', 304, 'DKK', 'Krone', 'DKK', 'GL.png', 299, 'Active'),
(85, 'Grenada', 'GD', 'GRD', 308, 'XCD', 'Dollar', '&#36;', 'GD.png', 1473, 'Active'),
(86, 'Guadeloupe', 'GP', 'GLP', 312, 'EUR', 'Euro', '&euro;', 'GP.png', 590, 'Active'),
(87, 'Guam', 'GU', 'GUM', 316, 'USD', 'Dollar', '&#36;', 'GU.png', 1671, 'Active'),
(88, 'Guatemala', 'GT', 'GTM', 320, 'GTQ', 'Quetzal', 'Q', 'GT.png', 502, 'Active'),
(89, 'Guinea', 'GN', 'GIN', 324, 'GNF', 'Franc', 'Fr', 'GN.png', 224, 'Active'),
(90, 'Guinea-Bissau', 'GW', 'GNB', 624, 'XOF', 'Franc', 'Fr', 'GW.png', 245, 'Active'),
(91, 'Guyana', 'GY', 'GUY', 328, 'GYD', 'Dollar', '&#36;', 'GY.png', 592, 'Active'),
(92, 'Haiti', 'HT', 'HTI', 332, 'HTG', 'Gourde', 'G', 'HT.png', 509, 'Active'),
(93, 'Heard Island and McDonald Islands', 'HM', 'HMD', 334, 'AUD', 'Dollar', '&#36;', 'HM.png', NULL, 'Active'),
(94, 'Honduras', 'HN', 'HND', 340, 'HNL', 'Lempira', 'L', 'HN.png', 504, 'Active'),
(95, 'Hong Kong', 'HK', 'HKG', 344, 'HKD', 'Dollar', '&#36;', 'HK.png', 852, 'Active'),
(96, 'Hungary', 'HU', 'HUN', 348, 'HUF', 'Forint', '&#70;&#116;', 'HU.png', 36, 'Active'),
(97, 'Iceland', 'IS', 'ISL', 352, 'ISK', 'Krona', 'kr.', 'IS.png', 354, 'Active'),
(98, 'India', 'IN', 'IND', 356, 'INR', 'Rupee', '&#8377;', 'IN.png', 91, 'Active'),
(99, 'Indonesia', 'ID', 'IDN', 360, 'IDR', 'Rupiah', 'Rp', 'ID.png', 62, 'Active'),
(100, 'Iran', 'IR', 'IRN', 364, 'IRR', 'Rial', '&#xfdfc;', 'IR.png', 98, 'Active'),
(101, 'Iraq', 'IQ', 'IRQ', 368, 'IQD', 'Dinar', '&#x639;.&#x62f;', 'IQ.png', 964, 'Active'),
(102, 'Ireland', 'IE', 'IRL', 372, 'EUR', 'Euro', '&euro;', 'IE.png', 353, 'Active'),
(103, 'Israel', 'IL', 'ISR', 376, 'ILS', 'Shekel', '&#8362;', 'IL.png', 972, 'Active'),
(104, 'Italy', 'IT', 'ITA', 380, 'EUR', 'Euro', '&euro;', 'IT.png', 39, 'Active'),
(105, 'Ivory Coast', 'CI', 'CIV', 384, 'XOF', 'Franc', 'Fr', 'CI.png', 225, 'Active'),
(106, 'Jamaica', 'JM', 'JAM', 388, 'JMD', 'Dollar', '&#36;', 'JM.png', 1876, 'Active'),
(107, 'Japan', 'JP', 'JPN', 392, 'JPY', 'Yen', '&yen;', 'JP.png', 81, 'Active'),
(108, 'Jordan', 'JO', 'JOR', 400, 'JOD', 'Dinar', '&#x62f;.&#x627;', 'JO.png', 962, 'Active'),
(109, 'Kazakhstan', 'KZ', 'KAZ', 398, 'KZT', 'Tenge', 'KZT', 'KZ.png', 7, 'Active'),
(110, 'Kenya', 'KE', 'KEN', 404, 'KES', 'Shilling', 'KSh', 'KE.png', 254, 'Active'),
(111, 'Kiribati', 'KI', 'KIR', 296, 'AUD', 'Dollar', '&#36;', 'KI.png', 686, 'Active'),
(112, 'Kuwait', 'KW', 'KWT', 414, 'KWD', 'Dinar', '&#x62f;.&#x643;', 'KW.png', 965, 'Active'),
(113, 'Kyrgyzstan', 'KG', 'KGZ', 417, 'KGS', 'Som', '&#x441;&#x43e;&#x43c;', 'KG.png', 996, 'Active'),
(114, 'Laos', 'LA', 'LAO', 418, 'LAK', 'Kip', '&#8365;', 'LA.png', 856, 'Active'),
(115, 'Latvia', 'LV', 'LVA', 428, 'LVL', 'Lat', NULL, 'LV.png', 371, 'Active'),
(116, 'Lebanon', 'LB', 'LBN', 422, 'LBP', 'Pound', '&#x644;.&#x644;', 'LB.png', 961, 'Active'),
(117, 'Lesotho', 'LS', 'LSO', 426, 'LSL', 'Loti', 'L', 'LS.png', 266, 'Active'),
(118, 'Liberia', 'LR', 'LBR', 430, 'LRD', 'Dollar', '&#36;', 'LR.png', 231, 'Active'),
(119, 'Libya', 'LY', 'LBY', 434, 'LYD', 'Dinar', '&#x644;.&#x62f;', 'LY.png', 218, 'Active'),
(120, 'Liechtenstein', 'LI', 'LIE', 438, 'CHF', 'Franc', '&#67;&#72;&#70;', 'LI.png', 423, 'Active'),
(121, 'Lithuania', 'LT', 'LTU', 440, 'LTL', 'Litas', NULL, 'LT.png', 370, 'Active'),
(122, 'Luxembourg', 'LU', 'LUX', 442, 'EUR', 'Euro', '&euro;', 'LU.png', 352, 'Active'),
(123, 'Macao', 'MO', 'MAC', 446, 'MOP', 'Pataca', 'P', 'MO.png', 853, 'Active'),
(124, 'Macedonia', 'MK', 'MKD', 807, 'MKD', 'Denar', '&#x434;&#x435;&#x43d;', 'MK.png', 389, 'Active'),
(125, 'Madagascar', 'MG', 'MDG', 450, 'MGA', 'Ariary', 'Ar', 'MG.png', 261, 'Active'),
(126, 'Malawi', 'MW', 'MWI', 454, 'MWK', 'Kwacha', 'MK', 'MW.png', 265, 'Active'),
(127, 'Malaysia', 'MY', 'MYS', 458, 'MYR', 'Ringgit', '&#82;&#77;', 'MY.png', 60, 'Active'),
(128, 'Maldives', 'MV', 'MDV', 462, 'MVR', 'Rufiyaa', '.&#x783;', 'MV.png', 960, 'Active'),
(129, 'Mali', 'ML', 'MLI', 466, 'XOF', 'Franc', 'Fr', 'ML.png', 223, 'Active'),
(130, 'Malta', 'MT', 'MLT', 470, 'MTL', 'Lira', NULL, 'MT.png', 356, 'Active'),
(131, 'Marshall Islands', 'MH', 'MHL', 584, 'USD', 'Dollar', '&#36;', 'MH.png', 692, 'Active'),
(132, 'Martinique', 'MQ', 'MTQ', 474, 'EUR', 'Euro', '&euro;', 'MQ.png', 596, 'Active'),
(133, 'Mauritania', 'MR', 'MRT', 478, 'MRO', 'Ouguiya', 'UM', 'MR.png', 222, 'Active'),
(134, 'Mauritius', 'MU', 'MUS', 480, 'MUR', 'Rupee', '&#x20a8;', 'MU.png', 230, 'Active'),
(135, 'Mayotte', 'YT', 'MYT', 175, 'EUR', 'Euro', '&euro;', 'YT.png', NULL, 'Active'),
(136, 'Mexico', 'MX', 'MEX', 484, 'MXN', 'Peso', '&#36;', 'MX.png', 52, 'Active'),
(137, 'Micronesia', 'FM', 'FSM', 583, 'USD', 'Dollar', '&#36;', 'FM.png', 691, 'Active'),
(138, 'Moldova', 'MD', 'MDA', 498, 'MDL', 'Leu', 'L', 'MD.png', 373, 'Active'),
(139, 'Monaco', 'MC', 'MCO', 492, 'EUR', 'Euro', '&euro;', 'MC.png', 377, 'Active'),
(140, 'Mongolia', 'MN', 'MNG', 496, 'MNT', 'Tugrik', '&#x20ae;', 'MN.png', 976, 'Active'),
(141, 'Montserrat', 'MS', 'MSR', 500, 'XCD', 'Dollar', '&#36;', 'MS.png', 1664, 'Active'),
(142, 'Morocco', 'MA', 'MAR', 504, 'MAD', 'Dirham', '&#x62f;.&#x645;.', 'MA.png', 212, 'Active'),
(143, 'Mozambique', 'MZ', 'MOZ', 508, 'MZN', 'Meticail', 'MT', 'MZ.png', 258, 'Active'),
(144, 'Myanmar', 'MM', 'MMR', 104, 'MMK', 'Kyat', 'Ks', 'MM.png', 95, 'Active'),
(145, 'Namibia', 'NA', 'NAM', 516, 'NAD', 'Dollar', '&#36;', 'NA.png', 264, 'Active'),
(146, 'Nauru', 'NR', 'NRU', 520, 'AUD', 'Dollar', '&#36;', 'NR.png', 674, 'Active'),
(147, 'Nepal', 'NP', 'NPL', 524, 'NPR', 'Rupee', '&#8360;', 'NP.png', 977, 'Active'),
(148, 'Netherlands', 'NL', 'NLD', 528, 'EUR', 'Euro', '&euro;', 'NL.png', 31, 'Active'),
(149, 'Netherlands Antilles', 'AN', 'ANT', 530, 'ANG', 'Guilder', '&fnof;', 'AN.png', 599, 'Active'),
(150, 'New Caledonia', 'NC', 'NCL', 540, 'XPF', 'Franc', 'Fr', 'NC.png', 687, 'Active'),
(151, 'New Zealand', 'NZ', 'NZL', 554, 'NZD', 'Dollar', '&#36;', 'NZ.png', 64, 'Active'),
(152, 'Nicaragua', 'NI', 'NIC', 558, 'NIO', 'Cordoba', 'C&#36;', 'NI.png', 505, 'Active'),
(153, 'Niger', 'NE', 'NER', 562, 'XOF', 'Franc', 'Fr', 'NE.png', 227, 'Active'),
(154, 'Nigeria', 'NG', 'NGA', 566, 'NGN', 'Naira', '&#8358;', 'NG.png', 234, 'Active'),
(155, 'Niue', 'NU', 'NIU', 570, 'NZD', 'Dollar', '&#36;', 'NU.png', 683, 'Active'),
(156, 'Norfolk Island', 'NF', 'NFK', 574, 'AUD', 'Dollar', '&#36;', 'NF.png', 672, 'Active'),
(157, 'North Korea', 'KP', 'PRK', 408, 'KPW', 'Won', '&#x20a9;', 'KP.png', 850, 'Active'),
(158, 'Northern Mariana Islands', 'MP', 'MNP', 580, 'USD', 'Dollar', '&#36;', 'MP.png', 1670, 'Active'),
(159, 'Norway', 'NO', 'NOR', 578, 'NOK', 'Krone', '&#107;&#114;', 'NO.png', 47, 'Active'),
(160, 'Oman', 'OM', 'OMN', 512, 'OMR', 'Rial', '&#x631;.&#x639;.', 'OM.png', 968, 'Active'),
(161, 'Pakistan', 'PK', 'PAK', 586, 'PKR', 'Rupee', '&#8360;', 'PK.png', 92, 'Active'),
(162, 'Palau', 'PW', 'PLW', 585, 'USD', 'Dollar', '&#36;', 'PW.png', 680, 'Active'),
(163, 'Palestinian Territory', 'PS', 'PSE', 275, 'ILS', 'Shekel', '&#8362;', 'PS.png', NULL, 'Active'),
(164, 'Panama', 'PA', 'PAN', 591, 'PAB', 'Balboa', 'B/.', 'PA.png', 507, 'Active'),
(165, 'Papua New Guinea', 'PG', 'PNG', 598, 'PGK', 'Kina', 'K', 'PG.png', 675, 'Active'),
(166, 'Paraguay', 'PY', 'PRY', 600, 'PYG', 'Guarani', '&#8370;', 'PY.png', 595, 'Active'),
(167, 'Peru', 'PE', 'PER', 604, 'PEN', 'Sol', 'S/.', 'PE.png', 51, 'Active'),
(168, 'Philippines', 'PH', 'PHL', 608, 'PHP', 'Peso', '&#8369;', 'PH.png', 63, 'Active'),
(169, 'Pitcairn', 'PN', 'PCN', 612, 'NZD', 'Dollar', '&#36;', 'PN.png', 0, 'Active'),
(170, 'Poland', 'PL', 'POL', 616, 'PLN', 'Zloty', '&#122;&#322;', 'PL.png', 48, 'Active'),
(171, 'Portugal', 'PT', 'PRT', 620, 'EUR', 'Euro', '&euro;', 'PT.png', 351, 'Active'),
(172, 'Puerto Rico', 'PR', 'PRI', 630, 'USD', 'Dollar', '&#36;', 'PR.png', 1787, 'Active'),
(173, 'Qatar', 'QA', 'QAT', 634, 'QAR', 'Rial', '&#x631;.&#x642;', 'QA.png', 974, 'Active'),
(174, 'Republic of the Congo', 'CG', 'COG', 178, 'XAF', 'Franc', 'Fr', 'CG.png', 242, 'Active'),
(175, 'Reunion', 'RE', 'REU', 638, 'EUR', 'Euro', '&euro;', 'RE.png', 262, 'Active'),
(176, 'Romania', 'RO', 'ROU', 642, 'RON', 'Leu', 'lei', 'RO.png', NULL, 'Active'),
(177, 'Russia', 'RU', 'RUS', 643, 'RUB', 'Ruble', '&#8381;', 'RU.png', 70, 'Active'),
(178, 'Rwanda', 'RW', 'RWA', 646, 'RWF', 'Franc', 'Fr', 'RW.png', 250, 'Active'),
(179, 'Saint Helena', 'SH', 'SHN', 654, 'SHP', 'Pound', '&pound;', 'SH.png', 290, 'Active'),
(180, 'Saint Kitts and Nevis', 'KN', 'KNA', 659, 'XCD', 'Dollar', '&#36;', 'KN.png', 1869, 'Active'),
(181, 'Saint Lucia', 'LC', 'LCA', 662, 'XCD', 'Dollar', '&#36;', 'LC.png', 1758, 'Active'),
(182, 'Saint Pierre and Miquelon', 'PM', 'SPM', 666, 'EUR', 'Euro', '&euro;', 'PM.png', 508, 'Active'),
(183, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 670, 'XCD', 'Dollar', '&#36;', 'VC.png', 1784, 'Active'),
(184, 'Samoa', 'WS', 'WSM', 882, 'WST', 'Tala', 'T', 'WS.png', 684, 'Active'),
(185, 'San Marino', 'SM', 'SMR', 674, 'EUR', 'Euro', '&euro;', 'SM.png', 378, 'Active'),
(186, 'Sao Tome and Principe', 'ST', 'STP', 678, 'STD', 'Dobra', 'Db', 'ST.png', 239, 'Active'),
(187, 'Saudi Arabia', 'SA', 'SAU', 682, 'SAR', 'Rial', '&#x631;.&#x633;', 'SA.png', 966, 'Active'),
(188, 'Senegal', 'SN', 'SEN', 686, 'XOF', 'Franc', 'Fr', 'SN.png', 221, 'Active'),
(189, 'Serbia and Montenegro', 'CS', 'SCG', 891, 'RSD', 'Dinar', '&#x434;&#x438;&#x43d;.', 'CS.png', NULL, 'Active'),
(190, 'Seychelles', 'SC', 'SYC', 690, 'SCR', 'Rupee', '&#x20a8;', 'SC.png', 248, 'Active'),
(191, 'Sierra Leone', 'SL', 'SLE', 694, 'SLL', 'Leone', 'Le', 'SL.png', 232, 'Active'),
(192, 'Singapore', 'SG', 'SGP', 702, 'SGD', 'Dollar', '&#36;', 'SG.png', 65, 'Active'),
(193, 'Slovakia', 'SK', 'SVK', 703, 'SKK', 'Koruna', NULL, 'SK.png', 421, 'Active'),
(194, 'Slovenia', 'SI', 'SVN', 705, 'EUR', 'Euro', '&euro;', 'SI.png', 386, 'Active'),
(195, 'Solomon Islands', 'SB', 'SLB', 90, 'SBD', 'Dollar', '&#36;', 'SB.png', 677, 'Active'),
(196, 'Somalia', 'SO', 'SOM', 706, 'SOS', 'Shilling', 'Sh', 'SO.png', 252, 'Active'),
(197, 'South Africa', 'ZA', 'ZAF', 710, 'ZAR', 'Rand', '&#82;', 'ZA.png', 27, 'Active'),
(198, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 239, 'GBP', 'Pound', '&pound;', 'GS.png', NULL, 'Active'),
(199, 'South Korea', 'KR', 'KOR', 410, 'KRW', 'Won', '&#8361;', 'KR.png', 82, 'Active'),
(200, 'Spain', 'ES', 'ESP', 724, 'EUR', 'Euro', '&euro;', 'ES.png', 34, 'Active'),
(201, 'Sri Lanka', 'LK', 'LKA', 144, 'LKR', 'Rupee', '&#xdbb;&#xdd4;', 'LK.png', 94, 'Active'),
(202, 'Sudan', 'SD', 'SDN', 736, 'SDD', 'Dinar', NULL, 'SD.png', 249, 'Active'),
(203, 'Suriname', 'SR', 'SUR', 740, 'SRD', 'Dollar', '&#36;', 'SR.png', 597, 'Active'),
(204, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 744, 'NOK', 'Krone', '&#107;&#114;', 'SJ.png', 47, 'Active'),
(205, 'Swaziland', 'SZ', 'SWZ', 748, 'SZL', 'Lilangeni', 'L', 'SZ.png', 268, 'Active'),
(206, 'Sweden', 'SE', 'SWE', 752, 'SEK', 'Krona', '&#107;&#114;', 'SE.png', 46, 'Active'),
(207, 'Switzerland', 'CH', 'CHE', 756, 'CHF', 'Franc', '&#67;&#72;&#70;', 'CH.png', 41, 'Active'),
(208, 'Syria', 'SY', 'SYR', 760, 'SYP', 'Pound', '&#x644;.&#x633;', 'SY.png', 963, 'Active'),
(209, 'Taiwan', 'TW', 'TWN', 158, 'TWD', 'Dollar', '&#78;&#84;&#36;', 'TW.png', 886, 'Active'),
(210, 'Tajikistan', 'TJ', 'TJK', 762, 'TJS', 'Somoni', '&#x405;&#x41c;', 'TJ.png', 992, 'Active'),
(211, 'Tanzania', 'TZ', 'TZA', 834, 'TZS', 'Shilling', 'Sh', 'TZ.png', 255, 'Active'),
(212, 'Thailand', 'TH', 'THA', 764, 'THB', 'Baht', '&#3647;', 'TH.png', 66, 'Active'),
(213, 'Togo', 'TG', 'TGO', 768, 'XOF', 'Franc', 'Fr', 'TG.png', 228, 'Active'),
(214, 'Tokelau', 'TK', 'TKL', 772, 'NZD', 'Dollar', '&#36;', 'TK.png', 690, 'Active'),
(215, 'Tonga', 'TO', 'TON', 776, 'TOP', 'Pa\'anga', 'T&#36;', 'TO.png', 676, 'Active'),
(216, 'Trinidad and Tobago', 'TT', 'TTO', 780, 'TTD', 'Dollar', '&#36;', 'TT.png', 1868, 'Active'),
(217, 'Tunisia', 'TN', 'TUN', 788, 'TND', 'Dinar', '&#x62f;.&#x62a;', 'TN.png', 216, 'Active'),
(218, 'Turkey', 'TR', 'TUR', 792, 'TRY', 'Lira', '&#8378;', 'TR.png', 90, 'Active'),
(219, 'Turkmenistan', 'TM', 'TKM', 795, 'TMM', 'Manat', NULL, 'TM.png', 7370, 'Active'),
(220, 'Turks and Caicos Islands', 'TC', 'TCA', 796, 'USD', 'Dollar', '&#36;', 'TC.png', 1649, 'Active'),
(221, 'Tuvalu', 'TV', 'TUV', 798, 'AUD', 'Dollar', '&#36;', 'TV.png', 688, 'Active'),
(222, 'U.S. Virgin Islands', 'VI', 'VIR', 850, 'USD', 'Dollar', '&#36;', 'VI.png', 1340, 'Active'),
(223, 'Uganda', 'UG', 'UGA', 800, 'UGX', 'Shilling', 'UGX', 'UG.png', 256, 'Active'),
(224, 'Ukraine', 'UA', 'UKR', 804, 'UAH', 'Hryvnia', '&#8372;', 'UA.png', 380, 'Active'),
(225, 'United Arab Emirates', 'AE', 'ARE', 784, 'AED', 'Dirham', '&#x62f;.&#x625;', 'AE.png', 971, 'Active'),
(226, 'United Kingdom', 'GB', 'GBR', 826, 'GBP', 'Pound', '&pound;', 'GB.png', 44, 'Active'),
(227, 'United States', 'US', 'USA', 840, 'USD', 'Dollar', '&#36;', 'US.png', 1, 'Active'),
(228, 'United States Minor Outlying Islands', 'UM', 'UMI', 581, 'USD', 'Dollar ', '&#36;', 'UM.png', NULL, 'Active'),
(229, 'Uruguay', 'UY', 'URY', 858, 'UYU', 'Peso', '&#36;', 'UY.png', 598, 'Active'),
(230, 'Uzbekistan', 'UZ', 'UZB', 860, 'UZS', 'Som', 'UZS', 'UZ.png', 998, 'Active'),
(231, 'Vanuatu', 'VU', 'VUT', 548, 'VUV', 'Vatu', 'Vt', 'VU.png', 678, 'Active'),
(232, 'Vatican', 'VA', 'VAT', 336, 'EUR', 'Euro', '&euro;', 'VA.png', 39, 'Active'),
(233, 'Venezuela', 'VE', 'VEN', 862, 'VEF', 'Bolivar', 'Bs F', 'VE.png', 58, 'Active'),
(234, 'Vietnam', 'VN', 'VNM', 704, 'VND', 'Dong', '&#8363;', 'VN.png', 84, 'Active'),
(235, 'Wallis and Futuna', 'WF', 'WLF', 876, 'XPF', 'Franc', 'Fr', 'WF.png', 681, 'Active'),
(236, 'Western Sahara', 'EH', 'ESH', 732, 'MAD', 'Dirham', '&#x62f;.&#x645;.', 'EH.png', 212, 'Active'),
(237, 'Yemen', 'YE', 'YEM', 887, 'YER', 'Rial', '&#xfdfc;', 'YE.png', 967, 'Active'),
(238, 'Zambia', 'ZM', 'ZMB', 894, 'ZMK', 'Kwacha', NULL, 'ZM.png', 260, 'Active'),
(239, 'Zimbabwe', 'ZW', 'ZWE', 716, 'ZWD', 'Dollar', NULL, 'ZW.png', 263, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `slug` varchar(256) NOT NULL,
  `description` text,
  `code` varchar(20) NOT NULL,
  `type` enum('percent','value') NOT NULL DEFAULT 'value',
  `value` decimal(10,0) NOT NULL,
  `max_discount_amount` decimal(10,2) DEFAULT '0.00',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `minimum_amount` decimal(10,0) DEFAULT NULL,
  `max_users` int(11) DEFAULT NULL,
  `user_once_per_customer` enum('1','0') NOT NULL DEFAULT '1',
  `categories` text,
  `exclude_products` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `user_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--


-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('header','footer','content') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'content',
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_updated_by` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `related_to` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `title`, `slug`, `type`, `subject`, `content`, `from_email`, `from_name`, `record_updated_by`, `created_at`, `updated_at`, `related_to`) VALUES
(1, 'header', 'header', 'header', 'header', '<p>Email</p>\r\n\r\n<div class=\"block\"><!-- Start of preheader -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody><!-- Spacing -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n					<tr>\r\n						<td>If you cannot read this email, please <a class=\"hlite\" href=\"#\" style=\"text-decoration: none; color: #0db9ea\"> click here </a></td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!-- End of preheader --></div>\r\n\r\n<div class=\"block\"><!-- start of header -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"border-bottom:1px solid #0db9ea; width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td><!-- logo -->\r\n						<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:280px\">\r\n							<tbody>\r\n								<tr>\r\n									<td>\r\n									<div class=\"imgpop\"><a href=\"#\"><img alt=\"logo\" class=\"logo\" src=\"http://conquerorslabs.com/exam2/public/uploads/settings/eKFhxlkXcMtX5xW.png\" style=\"border:none; display:block; outline:none; text-decoration:none\" /> </a></div>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						<!-- End of logo --><!-- menu -->\r\n\r\n						<table align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:280px\">\r\n							<tbody>\r\n								<tr>\r\n									<td><a href=\"#\" style=\"text-decoration: none; color: #ffffff;\">HOME </a> | <a href=\"#\" style=\"text-decoration: none; color: #ffffff;\"> ABOUT </a> | <a href=\"#\" style=\"text-decoration: none; color: #ffffff;\"> SHOP </a></td>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						<!-- End of Menu --></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!-- end of header --></div>\r\n', 'no@noemail.com', 'Test', 1, '2016-07-19 11:53:14', '2016-10-18 19:54:33', 'basic_system'),
(2, 'footer', 'footer', 'footer', 'footer', '<div class=\"block\">\r\n    <!-- Start of preheader -->\r\n    <table bgcolor=\"#f6f4f5\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" st-sortable=\"postfooter\" width=\"100%\">\r\n        <tbody>\r\n            <tr>\r\n                <td width=\"100%\">\r\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" width=\"580\">\r\n                        <tbody>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td align=\"center\" st-content=\"preheader\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999\" valign=\"middle\">\r\n                                    If you don\'t want to receive updates. please\r\n                                    <a class=\"hlite\" href=\"#\" style=\"text-decoration: none; color: #0db9ea\">\r\n                                        unsubscribe\r\n                                    </a>\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                        </tbody>\r\n                    </table>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n    <!-- End of preheader -->\r\n</div>', 'no@noemail.com', 'Test', 2, '2016-07-19 11:54:08', '2016-07-19 12:00:21', 'basic_system'),
(3, 'exam-result', 'exam-result', 'content', 'Exam Result', '<div class=\"block\">\r\n   <!-- Full + text -->\r\n   <table width=\"100%\" bgcolor=\"#f6f4f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"fullimage\">\r\n      <tbody>\r\n         <tr>\r\n            <td>\r\n               <table bgcolor=\"#ffffff\" width=\"580\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidth\" modulebg=\"edit\">\r\n                  <tbody>\r\n                     <tr>\r\n                        <td width=\"100%\" height=\"20\"></td>\r\n                     </tr>\r\n                     <tr>\r\n                        <td>\r\n                           <table width=\"540\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" class=\"devicewidthinner\">\r\n                              <tbody>\r\n                                 <!-- title -->\r\n                                 <tr>\r\n                                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #333333; text-align:left;line-height: 20px;\" st-title=\"rightimage-title\"> LOREM IPSUM </td>\r\n                                 </tr>\r\n                                 <!-- end of title -->\r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"10\"></td>\r\n                                 </tr>\r\n                                 <!-- Spacing -->\r\n                                 <!-- content -->\r\n                                 <tr>\r\n                                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #666666; text-align:left;line-height: 24px;\" st-content=\"rightimage-paragraph\"> {{ $content }} </td>\r\n                                 </tr>\r\n                                 <!-- end of content -->\r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"10\"></td>\r\n                                 </tr>\r\n                                 \r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"10\"></td>\r\n                                 </tr>\r\n                                 <!-- button -->\r\n                                 <tr>\r\n                                    <td>\r\n                                       <table height=\"30\" align=\"left\" valign=\"middle\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" st-button=\"edit\">\r\n                                          <tbody>\r\n                                             <tr>\r\n                                                <td width=\"auto\" align=\"center\" valign=\"middle\" height=\"30\" style=\" background-color:#0db9ea; border-top-left-radius:4px; border-bottom-left-radius:4px;border-top-right-radius:4px; border-bottom-right-radius:4px; background-clip: padding-box;font-size:13px; font-family:Helvetica, arial, sans-serif; text-align:center;  color:#ffffff; font-weight: 300; padding-left:18px; padding-right:18px;\"> <span style=\"color: #ffffff; font-weight: 300;\">\r\n                                                   <a style=\"color: #ffffff; text-align:center;text-decoration: none;\" href=\"#\">Read More</a>\r\n                                                   </span> \r\n                                                </td>\r\n                                             </tr>\r\n                                          </tbody>\r\n                                       </table>\r\n                                    </td>\r\n                                 </tr>\r\n                                 <!-- /button -->\r\n                                 <!-- Spacing -->\r\n                                 <tr>\r\n                                    <td width=\"100%\" height=\"20\"></td>\r\n                                 </tr>\r\n                                 <!-- Spacing -->\r\n                              </tbody>\r\n                           </table>\r\n                        </td>\r\n                     </tr>\r\n                  </tbody>\r\n               </table>\r\n            </td>\r\n         </tr>\r\n      </tbody>\r\n   </table>\r\n</div>', 'admin@gmail.com', 'Test', 2, '2016-07-19 12:07:51', '2016-07-19 12:07:51', NULL),
(4, 'registration', 'registration', '', 'Welcome', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									You have successfully registered with Academia. Enjoy the facilities provided by our system.</p>\r\n									\r\n									<p>Click <a href=\"{{URL_USERS_CONFIRM . \'/\' . $confirmation_code}}\">here</a> to activate your account</p>\r\n									\r\n									<p>User Name : {{ $username }}</p>\r\n									<p>Password : {{ $password }}</p>\r\n									\r\n									\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Academia Admin', 1, '2016-07-29 09:18:18', '2016-10-20 01:40:05', 'basic_system'),
(5, 'subscription', 'subscription', '', 'Subscription Successfull', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">Dear {{ $username }},<br />\r\n									You have successfully subscribed to {{ ucfirst($plan)}} plan with transaction {{$id}}. Enjoy the facilities provided by our system.</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Jack', 1, '2016-08-03 06:30:58', '2016-09-03 07:29:12', NULL),
(6, 'offline_subscription_failed', 'offline-subscription-failed', 'content', 'Offline Subscription Failed', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your attempt for offline subscription is failed.</p>\r\n\r\n									<p>Please find the admin comment</p>\r\n\r\n									<p><u><strong>Admin Comment:</strong></u></p>\r\n\r\n									<p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 16:01:47', '2016-10-18 20:06:14', NULL),
(7, 'offline_subscription_success', 'offline-subscription-success', 'content', 'Offline Subscription Success', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your attempt for offline subscription is success. &nbsp;</p>\r\n\r\n									<p><u><strong>Admin Comment</strong></u></p>\r\n\r\n									<p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color: rgb(13, 185, 234); text-align: justify;\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 16:05:32', '2016-10-18 19:57:15', NULL),
(8, 'subscription_success', 'subscription-success', '', 'Your Subscription was Success', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your subscription to {{ ucfirst($plan)}} plan is success. &nbsp;</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-19 21:01:21', '2016-10-19 21:01:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(512) DEFAULT NULL,
  `slug` varchar(512) DEFAULT NULL,
  `description` text,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `icon` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--


-- --------------------------------------------------------

--
-- Table structure for table `free_bies`
--

CREATE TABLE `free_bies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `download_count` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `free_bies`
--


-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_rtl` int(11) NOT NULL,
  `is_default` tinyint(2) NOT NULL DEFAULT '0',
  `is_default_admin` tinyint(2) DEFAULT '0',
  `phrases` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `is_default_admin`, `phrases`, `created_at`, `updated_at`) VALUES
(9, 'English', 'english-1', 'en', 0, 1, 1, '{\"get_\":\"Get \",\"for_just_\":\" For Just \",\"click_here_to_select\":\"Click Here To Select\",\"home\":\"Home\",\"products\":\"PRODUCTS\",\"login\":\"LOGIN\",\"home_page_banner_heading\":\"Home Page Banner Heading\",\"home_page_banner_sub_heading\":\"Home Page Banner Sub Heading\",\"search\":\"Search\",\"search_in_all_categories\":\"Search In All Categories\",\"today_offer\":\"TODAY OFFER\",\"this_offer_expires_on\":\"This Offer Expires On\",\"days\":\"Days\",\"hours\":\"Hours\",\"mins\":\"Mins\",\"sec\":\"Sec\",\"view_details\":\"VIEW DETAILS\",\"my_dashboard\":\"My Dashboard\",\"categories\":\"CATEGORIES\",\"view_all\":\"View All\",\"coupons\":\"Coupons\",\"pages\":\"Pages\",\"users\":\"Users\",\"settings\":\"Settings\",\"payment_reports\":\"Payment Reports\",\"latest_users\":\"Latest Users\",\"sign_out\":\"Sign Out\",\"online\":\"Online\",\"dashboard\":\"Dashboard\",\"all\":\"All\",\"owners\":\"Owners\",\"admins\":\"Admins\",\"executives\":\"Executives\",\"vendors\":\"Vendors\",\"customers\":\"Customers\",\"add\":\"Add\",\"import\":\"Import\",\"list\":\"List\",\"licences\":\"Licences\",\"templates\":\"Templates\",\"list_email_templates\":\"List Email Templates\",\"list_sms_templates\":\"List Sms Templates\",\"offers\":\"Offers\",\"online_reports\":\"Online Reports\",\"offline_reports\":\"Offline Reports\",\"export\":\"Export\",\"languages\":\"Languages\",\"buy_\":\"Buy \",\"online_payments\":\"Online Payments\",\"payments\":\"Payments\",\"success\":\"Success\",\"pending\":\"Pending\",\"cancelled\":\"Cancelled\",\"payment_statistics\":\"Payment Statistics\",\"payment_monthly_statistics\":\"Payment Monthly Statistics\",\"all_payments\":\"All Payments\",\"image\":\"Image\",\"user_name\":\"User Name\",\"item\":\"Item\",\"product_owner\":\"Product Owner\",\"payment_gateway\":\"Payment Gateway\",\"updated_at\":\"Updated At\",\"payment_status\":\"Payment Status\",\"offline_payment_details\":\"Offline Payment Details\",\"name\":\"Name\",\"cost\":\"Cost\",\"coupon_applied\":\"Coupon Applied\",\"discount\":\"Discount\",\"after_discount\":\"After Discount\",\"plan_type\":\"Plan Type\",\"notes\":\"Notes\",\"created_at\":\"Created At\",\"comments\":\"Comments\",\"approve\":\"Approve\",\"reject\":\"Reject\",\"close\":\"Close\",\"no\":\"No\",\"yes\":\"Yes\",\"please_select\":\"Please Select\",\"cart\":\"CART\",\"your_cart\":\"Your Cart\",\"product_name\":\"Product Name\",\"product_price\":\"Product Price\",\"options\":\"Options\",\"total_cart\":\"TOTAL CART\",\"products_price_:\":\"PRODUCTS PRICE :\",\"tax_:\":\"TAX :\",\"support_fee_:\":\"SUPPORT FEE :\",\"total_price_:\":\"TOTAL PRICE :\",\"check_out\":\"Check Out\",\"continue_shopping\":\"Continue Shopping\",\"proceed_to_checkout\":\"Proceed To Checkout\",\"your_cart_is_empty\":\"Your Cart Is Empty\",\"most_popular\":\"Most Popular\",\"featured\":\"Featured\",\"latest\":\"Latest\",\"freebies\":\"Freebies\",\"details\":\"Details\",\"buy_now\":\"Buy Now\",\"popular\":\"Popular\",\"success_list\":\"Success List\",\"pending_list\":\"Pending List\",\"cancelled_list\":\"Cancelled List\",\"paid_amount\":\"Paid Amount\",\"payment_cost\":\"Payment Cost\",\"products_dashboard\":\"Products Dashboard\",\"s_no\":\"S.NO\",\"title\":\"Title\",\"price\":\"Price\",\"status\":\"Status\",\"action\":\"Action\",\"are_you_sure\":\"Are You Sure\",\"you_will_not_be_able_to_recover_this_record\":\"You Will Not Be Able To Recover This Record\",\"delete_it\":\"Delete It\",\"cancel_please\":\"Cancel Please\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"your_record_has_been_deleted\":\"Your Record Has Been Deleted\",\"your_record_is_safe\":\"Your Record Is Safe\",\"product_details\":\"Product Details\",\"sales\":\"Sales\",\"amount\":\"Amount\",\"product_categories\":\"Product Categories\",\"categories_list\":\"Categories List\",\"sno\":\"Sno\",\"category\":\"Category\",\"product_sales\":\"Product Sales\",\"customer_name\":\"Customer Name\",\"date\":\"Date\",\"customer_email\":\"Customer Email\",\"see_all_products\":\"SEE ALL PRODUCTS\",\"offline_payments\":\"Offline Payments\",\"create\":\"Create\",\"module\":\"Module\",\"key\":\"Key\",\"description\":\"Description\",\"edit\":\"Edit\",\"view\":\"View\",\"master_settings\":\"Master Settings\",\"site_title\":\"Site Title\",\"site_logo\":\"Site Logo\",\"site_address\":\"Site Address\",\"site_city\":\"Site City\",\"site_favicon\":\"Site Favicon\",\"site_state\":\"Site State\",\"site_country\":\"Site Country\",\"site_zipcode\":\"Site Zipcode\",\"site_phone\":\"Site Phone\",\"system_timezone\":\"System Timezone\",\"background_image\":\"Background Image\",\"current_theme\":\"Current Theme\",\"currency_code\":\"Currency Code\",\"terms_and_conditions\":\"Terms And Conditions\",\"privacy_policy\":\"Privacy Policy\",\"date_format\":\"Date Format\",\"update\":\"Update\",\"mail_driver\":\"Mail Driver\",\"mail_host\":\"Mail Host\",\"mail_port\":\"Mail Port\",\"mail_username\":\"Mail Username\",\"mail_password\":\"Mail Password\",\"mail_encryption\":\"Mail Encryption\",\"setting_key\":\"Setting Key\",\"tool_tip\":\"Tool Tip\",\"type\":\"Type\",\"default_value\":\"Default Value\",\"total_options\":\"Total Options\",\"option_value\":\"Option Value\",\"option_text\":\"Option Text\",\"make_default\":\"Make Default\",\"mailchimp_apikey\":\"Mailchimp Apikey\",\"mailchimp_list_id\":\"Mailchimp List Id\",\"email_address\":\"Email Address\",\"this_field_is_required\":\"This Field Is Required\",\"sign_up\":\"Sign Up\",\"please_enter_email_address\":\"Please Enter Email Address\",\"please_enter_valid_email_address\":\"Please Enter Valid Email Address\",\"thanks_for_your_subscription\":\"Thanks For Your Subscription\",\"400:_dadada@dsdada_ff_is_already_a_list_member__use_put_to_insert_or_update_list_members_\":\"400: Dadada@dsdada.ff Is Already A List Member. Use Put To Insert Or Update List Members.\",\"facebook\":\"Facebook\",\"twitter\":\"Twitter\",\"googleplus\":\"Googleplus\",\"linkedin\":\"Linkedin\",\"dribble\":\"Dribble\",\"pinterest\":\"Pinterest\",\"invalid_setting\":\"Invalid Setting\",\"copy_rights\":\"Copy Rights\",\"licences_dashboard\":\"Licences Dashboard\",\"user\":\"User\",\"duration\":\"Duration\",\"licences_list\":\"Licences List\",\"eg:_standard_licence\":\"Eg: Standard Licence\",\"enter_decription\":\"Enter Decription\",\"day(s)\":\"Day(s)\",\"month(s)\":\"Month(s)\",\"year(s)\":\"Year(s)\",\"duration_type\":\"Duration Type\",\"select\":\"Select\",\"menus\":\"Menus\",\"items\":\"Items\",\"menu_list\":\"Menu List\",\"eg:_main_menu\":\"Eg: Main Menu\",\"menu_items\":\"Menu Items\",\"url\":\"URL\",\"title_of_the_menu_item\":\"Title Of The Menu Item\",\"same_page\":\"Same Page\",\"other_page\":\"Other Page\",\"open_in\":\"Open In\",\"print_in_same_place\":\"Print In Same Place\",\"url_content\":\"Url Content\",\"use_description\":\"Use Description\",\"display\":\"Display\",\"menu_active_title\":\"MENU ACTIVE TITLE\",\"order\":\"Order\",\"select_payment_method\":\"Select Payment Method\",\"first_name\":\"First Name\",\"last_name\":\"Last Name\",\"billinf_address\":\"Billinf Address\",\"address_line1\":\"Address Line1\",\"address_line2\":\"Address Line2\",\"city\":\"City\",\"zip_code\":\"Zip Code\",\"state\\/province\":\"State\\/province\",\"country\":\"Country\",\"have_coupon_code?\":\"Have Coupon Code?\",\"apply\":\"Apply\",\"please_enter_first_name\":\"Please Enter First Name\",\"info\":\"Info\",\"please_select_payment_gateway\":\"Please Select Payment Gateway\",\"please_enter_coupon_code\":\"Please Enter Coupon Code\",\"code\":\"Code\",\"value\":\"Value\",\"start_date\":\"Start Date\",\"end_date\":\"End Date\",\"wah!!_coupon_applied_successfully\":\"Wah!! Coupon Applied Successfully\",\"coupon_code\":\"Coupon Code\",\"applied\":\" Applied\",\"reduced_from_the_cart\":\" Reduced From The Cart\",\"coupon_has_been_removed_from_the_cart\":\"Coupon Has Been Removed From The Cart\",\"create_message\":\"Create Message\",\"inbox\":\"Inbox\",\"compose\":\"Compose\",\"messages\":\"Messages\",\"all_users\":\" All Users\",\"coupon_code_off_:\":\"COUPON CODE OFF :\",\"offline_payment\":\"Offline Payment\",\"warning\":\"Warning\",\"do_not_refresh_this_page\":\"Do Not Refresh This Page\",\"submit\":\"Submit\",\"offline_payment_instructions\":\"Offline Payment Instructions\",\"payment_details\":\"Payment Details\",\"edit_account_information\":\"Edit Account Information\",\"profile_image\":\"Profile Image\",\"password\":\"Password\",\"re-enter_password\":\"Re-enter Password\",\"edit_billing_address\":\"Edit Billing Address\",\"file_type_not_allowed\":\"File Type Not Allowed\",\"licence_price\":\"Licence Price\",\"tax\":\"Tax\",\"products_list\":\"Products List\",\"invalid_input\":\"Invalid Input\",\"the_text_is_too_short\":\"The Text Is Too Short\",\"the_text_is_too_long\":\"The Text Is Too Long\",\"format\":\"Format\",\"active\":\"Active\",\"inactive\":\"Inactive\",\"is_featured\":\"Is Featured\",\"please_select_categorie(s)\":\"Please Select Categorie(s)\",\"price_settings\":\"Price Settings\",\"default\":\"Default\",\"variable\":\"Variable\",\"price_type\":\"Price Type\",\"eg:_2\":\"Eg: 2\",\"price_display_type\":\"Price Display Type\",\"checkbox\":\"Checkbox\",\"radio\":\"Radio\",\"option_name\":\"Option Name\",\"id\":\"Id\",\"add_new_price\":\"Add New Price\",\"download_files\":\"Download Files\",\"file_name\":\"File Name\",\"file_url\":\"File Url\",\"price_assignment\":\"Price Assignment\",\"add_new_file\":\"Add New File\",\"download_limits\":\"Download Limits\",\"leave_blank_for_global_setting_or_0_for_unlimited\":\"Leave Blank For Global Setting Or 0 For Unlimited\",\"limit_the_number_of_times_a_customer_who_purchased_this_product_can_access_their_download_links_\":\"Limit The Number Of Times A Customer Who Purchased This Product Can Access Their Download Links.\",\"demo_link\":\"Demo Link\",\"demo_link_eg:_http:\\/\\/site_com\":\"Demo Link Eg: Http:\\/\\/site.com\",\"preview_image\":\"Preview Image\",\"licence_of_use\":\"Licence Of Use\",\"licence_of_use_for_the_product\":\"Licence Of Use For The Product\",\"technical_info\":\"TECHNICAL INFO\",\"technical_info_for_the_product\":\"Technical Info For The Product\",\"description_for_the_product\":\"Description For The Product\",\"download_notes\":\"Download Notes\",\"download_notes_for_the_product\":\"Download Notes For The Product\",\"title_meta_tag\":\"Title Meta Tag\",\"product_seo_title\":\"Product Seo Title\",\"description_meta_tag\":\"Description Meta Tag\",\"kewords_meta_tag\":\"Kewords Meta Tag\",\"kewords_meta_tags_separated_with_comma(,)\":\"Kewords Meta Tags Separated With Comma(,)\",\"please_select_licences(s)\":\"Please Select Licences(s)\",\"add_products\":\"Add Products\",\"remove_price_option_%s\":\"Remove Price Option %s\",\"please_select_type\":\"Please Select Type\",\"file\":\"File\",\"share:\":\"Share:\",\"about_author\":\"ABOUT AUTHOR\",\"products_:_\":\"Products : \",\"product_info\":\"PRODUCT INFO\",\"downloads\":\"Downloads\",\"related_products\":\"RELATED PRODUCTS\",\"purchase_history\":\"Purchase History\",\"logout\":\"LOGOUT\",\"no_purchases_found_found\":\"No Purchases Found Found\",\"click_%s_to_purchase\":\"Click %s To Purchase\",\"here\":\"Here\",\"dribbble\":\"Dribbble\",\"about_me\":\"About Me\",\"about_me_few_words\":\"About Me Few Words\",\"categories_dashboard\":\"Categories Dashboard\",\"sub-cats\":\"Sub-cats\",\"sort_order\":\"Sort Order\",\"eg:_wordpress_templates\":\"Eg: Wordpress Templates\",\"enter_purpose_of_the_category\":\"Enter Purpose Of The Category\",\"meta_tag_title\":\"Meta Tag Title\",\"meta_description\":\"Meta Description\",\"meta_keywords\":\"Meta Keywords\",\"eg:_soft_order\":\"Eg: Soft Order\",\"show_in_menu\":\"Show In Menu\",\"select_parent\":\"Select Parent\",\"owner_users\":\" Owner Users\",\"executive_users\":\" Executive Users\",\"users_management\":\"Users Management\",\"please_enter_valid_email\":\"Please Enter Valid Email\",\"please_enter_about_user\":\"Please Enter About User\",\"register\":\"Register\",\"great,_join_with_us\":\"Great, Join With Us\",\"register_sub_heading\":\"Register Sub Heading\",\"by_creating_an_account_you_agree_to_our\":\"By Creating An Account You Agree To Our\",\"and_our\":\"And Our\",\"already_having_account?\":\"Already Having Account?\",\"login_here\":\"Login Here\",\"please_enter_password\":\"Please Enter Password\",\"password_should_be_at_least_6_characters\":\"Password Should Be At Least 6 Characters\",\"please_enter_password_again_to_confirm\":\"Please Enter Password Again To Confirm\",\"password_and_re-enter_password_not_same\":\"Password And Re-enter Password Not Same\",\"user_status\":\"User Status\",\"registered\":\"Registered\",\"suspended\":\"Suspended\",\"user_users\":\" User Users\",\"dashborad\":\"Dashborad\",\"users_dashboard\":\"Users Dashboard\",\"details_of\":\"Details Of\",\"purchases\":\"Purchases\",\"live_demo\":\"Live Demo\",\"regular_licence\":\"Regular Licence\",\"buy\":\"BUY\",\"license_of_use\":\"LICENSE OF USE\",\"tags\":\"Tags\",\"subject\":\"Subject\",\"from_email\":\"From Email\",\"from_name\":\"From Name\",\"templates_management\":\"Templates Management\",\"header\":\"Header\",\"footer\":\"Footer\",\"content\":\"Content\",\"eg:_admin@admin_com\":\"Eg: Admin@admin.com\",\"email\":\"Email\",\"sms\":\"Sms\",\"content_for_the_template\":\"Content For The Template\",\"record_deleted_successfully\":\"Record Deleted Successfully\",\"admin_users\":\" Admin Users\",\"vendor_users\":\" Vendor Users\",\"import_users\":\"Import Users\",\"download_template_here\":\"Download Template Here\",\"excel\":\"Excel\",\"eg:_introduction_offer\":\"Eg: Introduction Offer\",\"create_user\":\"Create User\",\"report\":\"Report\",\"add_to_cart\":\"Add To Cart\",\"uploads\":\"Uploads\",\"no_products_found\":\"No Products Found\",\"failed\":\"Failed\",\"phone\":\"Phone\",\"address\":\"Address\",\"import_categories\":\"Import Categories\",\"parent_id\":\"Parent Id\",\"meta_tag_description\":\"Meta Tag Description\",\"meta_tag_keywords\":\"Meta Tag Keywords\",\"add_coupon\":\"Add Coupon\",\"coupon_title\":\"Coupon Title\",\"eg:_326f6\":\"Eg: 326f6\",\"percent\":\"Percent\",\"eg:_23\":\"Eg: 23\",\"minimum_amount\":\"Minimum Amount\",\"minimum_amount__leave_0_for_no_minimum_amount_limitation_\":\"Minimum Amount. Leave 0 For No Minimum Amount Limitation.\",\"exclude_products\":\"Exclude Products\",\"max_users\":\"Max Users\",\"max_users__leave_0_for_unlimited_users\":\"Max Users. Leave 0 For Unlimited Users\",\"user_once_per_customer\":\"User Once Per Customer\",\"billing_address1\":\"Billing Address1\",\"role_id\":\"Role Id\",\"view_template\":\"View Template\",\"slug\":\"Slug\",\"sorry!!_coupon_not_found\":\"Sorry!! Coupon Not Found\",\"sorry!!_this_coupon_is_not_applicable_for_this_category_of_products\":\"Sorry!! This Coupon Is Not Applicable For This Category Of Products\",\"role\":\"Role\",\"template_type\":\"Template Type\",\"add_offers\":\"Add Offers\",\"eg:_contact_us\":\"Eg: Contact Us\",\"please_select_product\":\"Please Select Product\",\"product\":\"Product\",\"use_product_title\":\"Use Product Title\",\"use_product_description\":\"Use Product Description\",\"use_product_image\":\"Use Product Image\",\"description_for_the_offer\":\"Description For The Offer\",\"export_payments_report\":\"Export Payments Report\",\"export_payment_records\":\"Export Payment Records\",\"download_excel\":\"Download Excel\",\"all_records\":\"All Records\",\"from_date\":\"From Date\",\"import_products\":\"Import Products\",\"to_date\":\"To Date\",\"payment_type\":\"Payment Type\",\"offline\":\"Offline\",\"edit_settings\":\"Edit Settings\",\"introduction\":\"Introduction\",\"parent\":\"Parent\",\"in-active\":\"In-active\",\"description_of_the_topic\":\"Description Of The Topic\",\"admin_commission_for_a_vendor_product\":\"Admin Commission For A Vendor Product\",\"admin_commission_:_\":\"Admin Commission : \",\"send_message\":\"Send Message\",\"profile\":\"Profile\",\"show_in_menu?\":\"Show In Menu?\",\"display_dynamic_pages\":\"Display Dynamic Pages\",\"display_pages\":\"Display Pages\",\"toggle_navigation\":\"Toggle Navigation\",\"billing_address\":\"Billing Address\",\"please_enter_your_message\":\"Please Enter Your Message\",\"message\":\"Message\",\"add_templates\":\"Add Templates\",\"phone_number\":\"Phone Number\",\"add_pages\":\"Add Pages\",\"code_not_valid\":\"Code Not Valid\",\"you_have_successfully_activated_your_account__please_login_here_\":\"You Have Successfully Activated Your Account. Please Login Here.\",\"reset_password\":\"Reset Password\",\"go_to_my_account\":\"Go To My Account\",\"please_fill_details_to_get_password\":\"Please Fill Details To Get Password\",\"send_password_reset_link\":\"Send Password Reset Link\",\"enable_taxes\":\"Enable Taxes\",\"tax_rate_type\":\"Tax Rate Type\",\"tax_rate\":\"Tax Rate\",\"prices_entered_with_tax\":\"Prices Entered With Tax\",\"display_tax_rate_on_prices\":\"Display Tax Rate On Prices\",\"display_during_checkout\":\"Display During Checkout\",\"currency_symbol\":\"Currency Symbol\",\"currency_position\":\"Currency Position\",\"display_currency\":\"Display Currency\",\"google_analytics\":\"Google Analytics\",\"currency\":\"Currency\",\"account_type\":\"Account Type\",\"payu_merchant_key\":\"Payu Merchant Key\",\"payu_salt\":\"Payu Salt\",\"payu_working_key\":\"Payu Working Key\",\"payu_testmode\":\"Payu Testmode\",\"offline_payment_information\":\"Offline Payment Information\",\"digi_downloads\":\"Digi Downloads\",\"have_account?\":\"Have Account?\",\"dont_have_account?_create_now\":\"Dont Have Account? Create Now\",\"confirm_password\":\"Confirm Password\",\"icon\":\"Icon\",\"faq\":\"FAQ\",\"language\":\"Language\",\"default_language\":\"Default Language\",\"update_strings\":\"Update Strings\",\"delete\":\"Delete\",\"enable\":\"Enable\",\"set_default\":\"Set Default\",\"disable\":\"Disable\",\"of\":\"Of\",\"my_profile\":\" My Profile\",\"change_password\":\" Change Password\",\"faqs\":\"Faqs\",\"about_us\":\"About Us\",\"contact_us\":\"Contact Us\",\"forgot_password\":\"Forgot Password\",\"admin_dashboard\":\"Admin Dashboard\",\"overall_users\":\"Overall Users\",\"roles\":\"Roles\",\"discounts\":\"Discounts\",\"email_templates\":\"Email Templates\",\"is_rtl\":\"Is Rtl\",\"record_updated_successfully\":\"Record Updated Successfully\",\"add_user\":\"Add User\",\"update_details\":\"Update Details\",\"minimum_bill\":\"Minimum Bill\",\"maximum_discount\":\"Maximum Discount\",\"limit\":\"Limit\",\"edit_user\":\"Edit User\",\"select_role\":\"Select Role\",\"add_language\":\"Add Language\",\"language_title\":\"Language Title\",\"language_code\":\"Language Code\",\"supported_language_codes\":\"Supported Language Codes\",\"edit_language\":\"Edit Language\",\"add_users\":\"Add Users\",\"create_category\":\"Create Category\",\"category_name\":\"Category Name\",\"please_upload_valid_image_type\":\"Please Upload Valid Image Type\",\"edit_template\":\"Edit Template\",\"welcome\":\"Welcome\",\"search_student\":\"Search Student\",\"feedback\":\" Feedback\",\"notifications\":\" Notifications\",\"_messages\":\" Messages\",\"_languages\":\" Languages\",\"_logout\":\" Logout\",\"please_wait\":\"Please Wait\",\"sorry_no_messages_available\":\"Sorry No Messages Available\",\"modules_helper\":\"Modules Helper\",\"steps\":\"Steps\",\"element_id\":\"Element Id\",\"placement\":\"Placement\",\"add_to_list\":\"Add To List\",\"element\":\"Element\",\"pages_dashboard\":\"Pages Dashboard\",\"liast\":\"Liast\",\"click\":\"Click\",\"to_register_as_customer\":\"To Register As Customer\",\"to_register_as_vendor\":\"To Register As Vendor\",\"download_files_url\":\"Download Files Url\",\"no_settings_available\":\"No Settings Available\",\"%s\":\" %s\",\"menu\":\"Menu\",\"view_offer\":\"View Offer\",\"start_date_time\":\"Start Date Time\",\"end_date_time\":\"End Date Time\",\"_sno\":\".sno\",\"sorry!!_coupon_code_has_expired\":\"Sorry!! Coupon Code Has Expired\",\"no_details_found\":\"No Details Found\",\"it_will_be_updated_by_adding_the_questions\":\"It Will Be Updated By Adding The Questions\",\"logged_out_successfully\":\"Logged Out Successfully\",\"edit_subject\":\"Edit Subject\",\"view_profile\":\"View Profile\",\"user_roles\":\"User Roles\",\"permissions\":\"Permissions\",\"add_role\":\"Add Role\",\"role_name\":\"Role Name\",\"display_name\":\"Display Name\",\"list_roles\":\"List Roles\",\"religions\":\"Religions\",\"this_field_id_required\":\"This Field Id Required\",\"record_added_successfully\":\"Record Added Successfully\",\"create_coupon\":\"Create Coupon\",\"discount_type\":\"Discount Type\",\"discount_value\":\"Discount Value\",\"enter_value\":\"Enter Value\",\"discount_maximum_amount\":\"Discount Maximum Amount\",\"valid_from\":\"Valid From\",\"valid_to\":\"Valid To\",\"usage_limit\":\"Usage Limit\",\"customername\":\"Customername\",\"customeremail\":\"Customeremail\",\"productsss\":\"Productsss\",\"by_creating_an_account_you_agree_to_our_\":\"By Creating An Account You Agree To Our \",\"product_sales_per_month\":\"Product Sales Per Month\",\"categoriessss\":\"CATEGORIESSSS\",\"discount_amount\":\"Discount Amount\",\"payments_dashboard\":\"Payments Dashboard\",\"exports\":\"Exports\",\"display_items\":\"Display Items\",\"no_strings_available\":\"No Strings Available\",\"enter_name\":\"Enter Name\",\"enter_title\":\"Enter Title\",\"product_infooo\":\"PRODUCT INFOOO\",\"offer_name\":\"Offer Name\",\"searchff\":\"Searchff\",\"pa\":\"Pa\",\"payment_gateways\":\"Payment Gateways\",\"page_not_found\":\"Page Not Found\",\"{{getprofilepath($record->image)}}_users\":\"{{getprofilepath($record->image)}} Users\",\"onlineee\":\"Onlineee\",\"loginmm\":\"Loginmm\",\"this_record_is_in_use_in_other_modules\":\"This Record Is In Use In Other Modules\",\"send\":\"Send\",\"updateee\":\"Updateee\",\"buy_nowee\":\"Buy Nowee\",\"check_outtt\":\"Check Outtt\",\"payment_status_:_pending\":\"Payment Status : Pending\",\"actual_cost_:_\":\"Actual Cost : \",\"tax_:_\":\"Tax : \",\"discount_:_\":\"Discount : \",\"amount_paid_:_\":\"Amount Paid : \",\"payment_status_:_\":\"Payment Status : \",\"purchase_details\":\"Purchase Details\",\"download_:_\":\"Download : \",\"payment_status_:_success\":\"Payment Status : Success\",\"400:_the_resource_submitted_could_not_be_validated__for_field-specific_details,_see_the_\'errors\'_array_\":\"400: The Resource Submitted Could Not Be Validated. For Field-specific Details, See The \'errors\' Array.\",\"sorry!!_you_need_to_purchase_at_least_\":\"Sorry!! You Need To Purchase At Least \",\"to_apply_this_coupon\":\" To Apply This Coupon\",\"ok\":\"Ok\",\"total_products\":\"Total Products\",\"customer_emailuuu\":\"Customer Emailuuu\",\"toggle navigation\":\"Toggle Navigation\",\"sign out\":\"Sign Out\",\"user_statistics\":\"User Statistics\",\"purchase history\":\"Purchase History\",\"edit account information\":\"Edit Account Information\",\"first name\":\"First Name\",\"last name\":\"Last Name\",\"profile image\":\"Profile Image\",\"email address\":\"Email Address\",\"re-enter password\":\"Re-enter Password\",\"edit billing address\":\"Edit Billing Address\",\"address line1\":\"Address Line1\",\"address line2\":\"Address Line2\",\"zip code\":\"Zip Code\",\"click here to select\":\"Click Here To Select\",\"my dashboard\":\"My Dashboard\",\"admin_commission : \":\"Admin Commission : \",\"add products\":\"Add Products\",\"please select categorie(s)\":\"Please Select Categorie(s)\",\"please select licences(s)\":\"Please Select Licences(s)\",\"price settings\":\"Price Settings\",\"eg: 2\":\"Eg: 2\",\"option name\":\"Option Name\",\"remove price option %s\":\"Remove Price Option %s\",\"add new price\":\"Add New Price\",\"download files\":\"Download Files\",\"file name\":\"File Name\",\"file url\":\"File Url\",\"price assignment\":\"Price Assignment\",\"please select type\":\"Please Select Type\",\"add new file\":\"Add New File\",\"leave blank for global setting or 0 for unlimited\":\"Leave Blank For Global Setting Or 0 For Unlimited\",\"limit the number of times a customer who purchased this product can access their download links.\":\"Limit The Number Of Times A Customer Who Purchased This Product Can Access Their Download Links.\",\"demo link\":\"Demo Link\",\"demo link eg: http:\\/\\/site.com\":\"Demo Link Eg: Http:\\/\\/site.com\",\"preview image\":\"Preview Image\",\"licence_of_use for the product\":\"Licence Of Use For The Product\",\"technical_info for the product\":\"Technical Info For The Product\",\"description for the product\":\"Description For The Product\",\"download notes for the product\":\"Download Notes For The Product\",\"title meta tag\":\"Title Meta Tag\",\"product seo title\":\"Product Seo Title\",\"description meta tag\":\"Description Meta Tag\",\"kewords meta tag\":\"Kewords Meta Tag\",\"kewords meta tags separated with comma(,)\":\"Kewords Meta Tags Separated With Comma(,)\",\"menu items\":\"Menu Items\",\"eg: main menu\":\"Eg: Main Menu\",\"enter decription\":\"Enter Decription\",\"display dynamic pages\":\"Display Dynamic Pages\",\"title of the menu item\":\"Title Of The Menu Item\",\"same page\":\"Same Page\",\"other page\":\"Other Page\",\"print in same place\":\"Print In Same Place\",\"open in\":\"Open In\",\"url content\":\"Url Content\",\"use description\":\"Use Description\",\"display pages\":\"Display Pages\",\"buy now\":\"Buy Now\",\"see all products\":\"SEE ALL PRODUCTS\",\"most popular\":\"Most Popular\",\"please enter email address\":\"Please Enter Email Address\",\"please enter valid email address\":\"Please Enter Valid Email Address\",\"from email\":\"From Email\",\"from name\":\"From Name\",\"add to cart\":\"Add To Cart\",\"regular licence\":\"Regular Licence\",\"about author\":\"ABOUT AUTHOR\",\"products : \":\"Products : \",\"product info\":\"PRODUCT INFO\",\"related products\":\"RELATED PRODUCTS\",\"please select\":\"Please Select\",\"your cart\":\"Your Cart\",\"product name\":\"Product Name\",\"product price\":\"Product Price\",\"continue shopping\":\"Continue Shopping\",\"total cart\":\"TOTAL CART\",\"products price :\":\"PRODUCTS PRICE :\",\"tax :\":\"TAX :\",\"support fee :\":\"SUPPORT FEE :\",\"total price :\":\"TOTAL PRICE :\",\"check out\":\"Check Out\",\"s.no\":\"S.NO\",\"vendor users\":\"Vendor Users\",\"owner users\":\"Owner Users\",\"no details found\":\"No Details Found\",\"import users\":\"Import Users\",\"download template here\":\"Download Template Here\",\"eg: introduction offer\":\"Eg: Introduction Offer\",\"import categories\":\"Import Categories\",\"add templates\":\"Add Templates\",\"eg: wordpress templates\":\"Eg: Wordpress Templates\",\"eg: admin@admin.com\":\"Eg: Admin@admin.com\",\"content for the template\":\"Content For The Template\",\"user status\":\"User Status\",\"all users\":\"All Users\",\"admin users\":\"Admin Users\",\"executive users\":\"Executive Users\",\"enter purpose of the category\":\"Enter Purpose Of The Category\",\"meta tag title\":\"Meta Tag Title\",\"meta keywords\":\"Meta Keywords\",\"meta description\":\"Meta Description\",\"select parent\":\"Select Parent\",\"add coupon\":\"Add Coupon\",\"coupon title\":\"Coupon Title\",\"eg: 326f6\":\"Eg: 326f6\",\"eg: 23\":\"Eg: 23\",\"minimum_amount. leave 0 for no minimum amount limitation.\":\"Minimum Amount. Leave 0 For No Minimum Amount Limitation.\",\"max users. leave 0 for unlimited users\":\"Max Users. Leave 0 For Unlimited Users\",\"eg: standard licence\":\"Eg: Standard Licence\",\"import products\":\"Import Products\",\"your cart is empty\":\"Your Cart Is Empty\",\"select payment method\":\"Select Payment Method\",\"billing address\":\"Billing Address\",\"have coupon code?\":\"Have Coupon Code?\",\"please enter first name\":\"Please Enter First Name\",\"please select payment gateway\":\"Please Select Payment Gateway\",\"please enter coupon code\":\"Please Enter Coupon Code\",\"payment_status : success\":\"Payment Status : Success\",\"actual_cost : \":\"Actual Cost : \",\"tax : \":\"Tax : \",\"discount : \":\"Discount : \",\"amount_paid : \":\"Amount Paid : \",\"payment_status : \":\"Payment Status : \",\"download : \":\"Download : \",\"no products found\":\"No Products Found\",\"sorry!! this coupon is not applicable for this category of products\":\"Sorry!! This Coupon Is Not Applicable For This Category Of Products\",\"coupon code\":\"Coupon Code\",\" applied\":\" Applied\",\" reduced from the cart\":\" Reduced From The Cart\",\"wah!! coupon applied successfully\":\"Wah!! Coupon Applied Successfully\",\"coupon code off :\":\"COUPON CODE OFF :\",\"sorry!! this coupon is not applicable for this product\":\"Sorry!! This Coupon Is Not Applicable For This Product\",\"sorry!! coupon code has expired\":\"Sorry!! Coupon Code Has Expired\",\"sorry!! coupon_not_found\":\"Sorry!! Coupon Not Found\",\"great, join with us\":\"Great, Join With Us\",\"to register as vendor\":\"To Register As Vendor\",\"by creating an account you agree to our \":\"By Creating An Account You Agree To Our \",\"terms and conditions\":\"Terms And Conditions\",\"and our\":\"And Our\",\"privacy policy\":\"Privacy Policy\",\"already having account?\":\"Already Having Account?\",\"login here\":\"Login Here\",\"please enter password\":\"Please Enter Password\",\"password should be at least 6 characters\":\"Password Should Be At Least 6 Characters\",\"please enter password again to confirm\":\"Please Enter Password Again To Confirm\",\"password and re-enter password not same\":\"Password And Re-enter Password Not Same\",\"reset password\":\"Reset Password\",\"go to my account\":\"Go To My Account\",\"please fill details to get password\":\"Please Fill Details To Get Password\",\"send password reset link\":\"Send Password Reset Link\",\"have account?\":\"Have Account?\",\"dont have account? create now\":\"Dont Have Account? Create Now\",\"pages dashboard\":\"Pages Dashboard\",\"eg: contact us\":\"Eg: Contact Us\",\"show in menu?\":\"Show In Menu?\",\"view template\":\"View Template\",\"please accept the terms and conditions\":\"Please Accept The Terms And Conditions\",\"add offers\":\"Add Offers\",\"start date\":\"Start Date\",\"please select product\":\"Please Select Product\",\"description for the offer\":\"Description For The Offer\",\"get \":\"Get \",\" for just \":\" For Just \",\"this offer expires on\":\"This Offer Expires On\",\"view details\":\"VIEW DETAILS\",\"buy \":\"Buy \",\"use_once_per_customer\":\"Use Once Per Customer\",\"customer_emailss\":\"Customer Emailss\",\"buyyy\":\"BUYYY\",\"view offer\":\"View Offer\",\"dueration\":\"Dueration\",\"customer_emailssss\":\"Customer Emailssss\",\"no purchases found\":\"No Purchases Found\",\"click %s to purchase\":\"Click %s To Purchase\",\"sales_list\":\"Sales List\",\"license of use\":\"LICENSE OF USE\",\"technical info\":\"TECHNICAL INFO\",\"sorry!! you need to purchase at least \":\"Sorry!! You Need To Purchase At Least \",\" to apply this coupon\":\" To Apply This Coupon\",\"cart_details\":\"Cart Details\",\"checkout\":\"Checkout\",\"live demo\":\"Live Demo\",\"to register as customer\":\"To Register As Customer\",\"created at\":\"Created At\",\"updated at\":\"Updated At\",\"sorry!! this coupon is used only once, you already used this coupon\":\"Sorry!! This Coupon Is Used Only Once, You Already Used This Coupon\",\"sorry!!  maximum user limit reached\":\"Sorry!!  Maximum User Limit Reached\",\"thank you for your purchase!\":\"Thank You For Your Purchase!\",\"customer_emailll\":\"Customer Emailll\",\"dash_board\":\"Dash Board\",\"$role_name users\":\"$role Name Users\",\"duration:\":\"Duration:\",\"more_offers\":\"More Offers\",\"detailsss\":\"Detailsss\",\"all_offers\":\"All Offers\",\"this offer expires on:\":\"This Offer Expires On:\",\"add to carttt\":\"Add To Carttt\",\"buy nowww\":\"Buy Nowww\",\"template type\":\"Template Type\",\"you have successfully activated your account. please login here.\":\"You Have Successfully Activated Your Account. Please Login Here.\",\"search by product\":\"Search By Product\",\"sales_amount\":\"Sales Amount\",\"download\":\"Download\",\"free_bies\":\"Free Bies\",\"free_bies_download_list\":\"Free Bies Download List\",\"self_upload\":\"Self Upload\",\"thrid_party\":\"Thrid Party\",\"product_belongsto\":\"Product Belongsto\",\"approve_status\":\"Approve Status\",\"product_approve_status\":\"Product Approve Status\",\"are_you_sure_to_make_approve_this_product\":\"Are You Sure To Make Approve This Product\",\"clear_file\":\"Clear File\",\"edit_product\":\"Edit Product\",\"are_you_sure_to_make_clear_file\":\"Are You Sure To Make Clear File\",\"clear_u_r_l\":\"Clear U R L\",\"total_sales\":\"Total Sales\",\"owner_name\":\"Owner Name\",\"total_revenue\":\"Total Revenue\",\"refresh-csrf users\":\"Refresh-csrf Users\",\"sorry!! vishnu this coupon is not applicable for this product\":\"Sorry!! Vishnu This Coupon Is Not Applicable For This Product\",\"sorry!! this coupon is not applicable for this products\":\"Sorry!! This Coupon Is Not Applicable For This Products\",\"max_discount_amount\":\"Max Discount Amount\",\"eg: 50\":\"Eg: 50\",\"it_is_set_to_default_language\":\"It Is Set To Default Language\",\"coupon_name\":\"Coupon Name\",\"licence_applied\":\"Licence Applied\",\"licence_name\":\"Licence Name\",\"licence_amount\":\"Licence Amount\",\"regular\":\"Regular\",\"product_name:\":\"Product Name:\",\"product_cost\":\"Product Cost\",\"paid_amont\":\"Paid Amont\",\"licence_fee\":\"Licence Fee\",\"licence\":\"Licence\",\"upload_purchases\":\"Upload Purchases\",\"view_more\":\"VIEW MORE\",\"log in\":\"Log In\",\"forgot password?\":\"Forgot Password?\",\"hope you enjoyed the shopping with us. visit again.\":\"Hope You Enjoyed The Shopping With Us. Visit Again.\",\"about us\":\"About Us\",\"digisamaritan\":\"Digisamaritan\",\"useful links\":\"Useful Links\",\"privacy and policy\":\"Privacy And Policy\",\"terms & conditions\":\"Terms & Conditions\",\"about us footer\":\"About Us Footer\",\"contact us\":\"Contact Us\",\"dummy text\":\"Dummy Text\",\"text one\":\"Text One\",\"text two\":\"Text Two\",\"text three\":\"Text Three\",\"our services\":\"Our Services\",\"services one\":\"Services One\",\"services two\":\"Services Two\",\"contact\":\"Contact\",\"\\u5e0c\\u671b\\u4f60\\u559c\\u6b22\\u4e0e\\u6211\\u4eec\\u4e00\\u8d77\\u8d2d\\u7269\\u3002\\u518d\\u6b21\\u8bbf\\u95ee\":\"\\u5e0c\\u671b\\u4f60\\u559c\\u6b22\\u4e0e\\u6211\\u4eec\\u4e00\\u8d77\\u8d2d\\u7269\\u3002\\u518d\\u6b21\\u8bbf\\u95ee\",\"log_in\":\"Log In\",\"forgot_password?\":\"Forgot Password?\",\"jack\":\"Jack\",\"jack@jarvis.com\":\"Jack@jarvis.com\",\"greate_join_with_us\":\"Greate Join With Us\",\"by_creating_an_account_you_agree_to_our \":\"By Creating An Account You Agree To Our \",\"please_accept_the_terms_and_conditions\":\"Please Accept The Terms And Conditions\",\"\\u0622\\u0645\\u0644 \\u0623\\u0646 \\u062a\\u0633\\u062a\\u0645\\u062a\\u0639 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0645\\u0639\\u0646\\u0627. \\u0632\\u0648\\u0631\\u0646\\u064a \\u0645\\u0631\\u0647 \\u0627\\u062e\\u0631\\u0649.\":\"\\u0622\\u0645\\u0644 \\u0623\\u0646 \\u062a\\u0633\\u062a\\u0645\\u062a\\u0639 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0645\\u0639\\u0646\\u0627. \\u0632\\u0648\\u0631\\u0646\\u064a \\u0645\\u0631\\u0647 \\u0627\\u062e\\u0631\\u0649.\",\"we have not found email address entered\":\"We Have Not Found Email Address Entered\",\"please check email address or password either one is wrong\":\"Please Check Email Address Or Password Either One Is Wrong\",\"ooops...!\":\"Ooops...!\",\"offersss\":\"Offersss\",\"product_format\":\"Product Format\",\"demo_link eg: http:\\/\\/site.com\":\"Demo Link Eg: Http:\\/\\/site.com\",\"seo_settings\":\"Seo Settings\",\"_empty_\":\"\",\"1\":\"1\",\"translation to \":\"Translation To \",\"static pages\\/fo\":\"Static Pages\\/fo\",\"video upload plugin\":\"Video Upload Plugin\",\"p2\":\"P2\",\"php scripts\":\"Php Scripts\",\"wordpress\":\"Wordpress\",\"ecommerce\":\"Ecommerce\",\" javascript\":\" Javascript\",\"css\":\"Css\",\"mobile\":\"Mobile\",\"html5\":\"Html5\",\"skins\":\"Skins\",\"plugins\":\"Plugins\",\".net\":\".net\",\"marketing\":\"Marketing\",\"cms themes\":\"Cms Themes\",\"muse templates\":\"Muse Templates\",\"ui design\":\"Ui Design\",\"blogging\":\"Blogging\",\"facebook templates\":\"Facebook Templates\",\"after effects project file\":\"After Effects Project File\",\"apple motion templates\":\"Apple Motion Templates\",\"motion graphics\":\"Motion Graphics\",\"stock footage\":\"Stock Footage\",\"cinema 4d templates\":\"Cinema 4d Templates\",\"animated svgs\":\"Animated Svgs\",\"video displays\":\"Video Displays\",\"form generator \":\"Form Generator \",\"fiverr script stats\":\"Fiverr Script Stats\",\"rating system\":\"Rating System\",\"search_by_product\":\"Search By Product\",\"add-ons\":\"Add-ons\",\"calendars\":\"Calendars\",\"countdowns\":\"Countdowns\",\"forms\":\"Forms\",\"vishnu-category\":\"Vishnu-category\",\"advertising\":\"Advertising\",\"forums\":\"Forums\",\"galleries\":\"Galleries\",\"media\":\"Media\",\"jigoshop\":\"Jigoshop\",\"magento extensions\":\"Magento Extensions\",\"opencart\":\"Opencart\",\"oscommerce\":\"Oscommerce\",\"prestashop\":\"Prestashop\",\"images and media\":\"Images And Media\",\"loaders and uploaders\":\"Loaders And Uploaders\",\"animations and effects\":\"Animations And Effects\",\"buttons\":\"Buttons\",\"charts and graphs\":\"Charts And Graphs\",\"layouts\":\"Layouts\",\"android\":\"Android\",\"ios\":\"Ios\",\"native web\":\"Native Web\",\"titanium\":\"Titanium\",\"3d\":\"3d\",\"canvas\":\"Canvas\",\"games\":\"Games\",\"libraries\":\"Libraries\",\"bootstrap\":\"Bootstrap\",\"layers wp style kits\":\"Layers Wp Style Kits\",\"miscellaneous\":\"Miscellaneous\",\"concrete5\":\"Concrete5\",\"drupal\":\"Drupal\",\"expression engine\":\"Expression Engine\",\"joomla\":\"Joomla\",\"content management\":\"Content Management\",\"email templates\":\"Email Templates\",\"instapage\":\"Instapage\",\"landing pages\":\"Landing Pages\",\"pagewiz\":\"Pagewiz\",\"moodle\":\"Moodle\",\"mura\":\"Mura\",\"webflow\":\"Webflow\",\"weebly\":\"Weebly\",\"corporate\":\"Corporate\",\"creative\":\"Creative\",\"landing\":\"Landing\",\"psd templates\":\"Psd Templates\",\"popular psd templates\":\"Popular Psd Templates\",\"sketch templates\":\"Sketch Templates\",\"popular sketch templates\":\"Popular Sketch Templates\",\"portfolio\":\"Portfolio\",\"ghost themes\":\"Ghost Themes\",\"blogger\":\"Blogger\",\"blog\":\"Blog\",\"business\":\"Business\",\"magazine\":\"Magazine\",\"photography\":\"Photography\",\"broadcast packages\":\"Broadcast Packages\",\"element 3d\":\"Element 3d\",\"elements\":\"Elements\",\"infographics\":\"Infographics\",\"logo stings\":\"Logo Stings\",\"openers\":\"Openers\",\"titles\":\"Titles\",\"backgrounds\":\"Backgrounds\",\"bugs\":\"Bugs\",\"interface effects\":\"Interface Effects\",\"lower thirds\":\"Lower Thirds\",\"buildings\":\"Buildings\",\"construction\":\"Construction\",\"education\":\"Education\",\"food\":\"Food\",\"products_price\":\"Products Price\",\"support_fee\":\"Support Fee\",\"total_price\":\"Total Price\",\"translation to any language\":\"Translation To Any Language\",\"form generator with payment system\":\"Form Generator With Payment System\",\"state_\\/_province\":\"State \\/ Province\",\"purchase\":\"Purchase\",\"enter_code_here\":\"Enter Code Here\",\"save_changes\":\"Save Changes\",\"approved\":\"Approved\",\"ooops..!\":\"Ooops..!\",\"you have no permission to access\":\"You Have No Permission To Access\",\"vishnu\":\"Vishnu\",\"\\u7c7b\\u522b\":\"\\u7c7b\\u522b\",\"add_category\":\"Add Category\",\"\\u4ea7\\u54c1\":\"\\u4ea7\\u54c1\",\"edit_coupon\":\"Edit Coupon\",\"add_licence\":\"Add Licence\",\"edit_licence\":\"Edit Licence\",\"event count widget\":\"Event Count Widget\",\"onlie vacation \":\"Onlie Vacation \",\"p3\":\"P3\",\"p4\":\"P4\",\"p5\":\"P5\",\"p8\":\"P8\",\"p7\":\"P7\",\"p6\":\"P6\",\"final product\":\"Final Product\",\"v1\":\"V1\",\"v2\":\"V2\",\"ooops\":\"Ooops\",\"something went wrong.please contact administrator\":\"Something Went Wrong.please Contact Administrator\",\"static pages\\/footer links\":\"Static Pages\\/footer Links\",\"your_subscription_was_successfull\":\"Your Subscription Was Successfull\",\"coupon_code_off\":\"Coupon Code Off\",\"cleanto\":\"Cleanto\",\"record was updated successfully\":\"Record Was Updated Successfully\",\"not_approved\":\"Not Approved\",\"record updated successfully\":\"Record Updated Successfully\",\"onlie vacation rentals booking calendar\":\"Onlie Vacation Rentals Booking Calendar\",\"edit_category\":\"Edit Category\",\"welcome_to_digi_downloads\":\"Welcome To Digi Downloads\",\"dont_have_account ?_create_it_now\":\"Dont Have Account ? Create It Now\",\"oops\":\"Oops\",\"can\'t write image data to path (uploads\\/users\\/thumbnail\\/10155.png)\":\"Can\'t Write Image Data To Path (uploads\\/users\\/thumbnail\\/10155.png)\",\"support\":\"Support\",\"can\'t write image data to path (uploads\\/users\\/thumbnail\\/1.jpeg)\":\"Can\'t Write Image Data To Path (uploads\\/users\\/thumbnail\\/1.jpeg)\",\"success...!\":\"Success...!\",\"reset password sent to your mail\":\"Reset Password Sent To Your Mail\",\"can\'t write image data to path (uploads\\/products\\/thumbnail\\/5859.png)\":\"Can\'t Write Image Data To Path (uploads\\/products\\/thumbnail\\/5859.png)\",\"can\'t write image data to path (uploads\\/products\\/thumbnail\\/6264.png)\":\"Can\'t Write Image Data To Path (uploads\\/products\\/thumbnail\\/6264.png)\",\"can\'t write image data to path (uploads\\/products\\/thumbnail\\/6265.png)\":\"Can\'t Write Image Data To Path (uploads\\/products\\/thumbnail\\/6265.png)\",\"your_payment_was cancelled\":\"Your Payment Was Cancelled\",\"vishnu-1\":\"Vishnu-1\",\"edd market place\":\"Edd Market Place\",\"vishnu-1 - test-1\":\"Vishnu-1 - Test-1\",\"vishnu-1 - test-2\":\"Vishnu-1 - Test-2\",\"about\":\"About\",\"how it works\":\"How It Works\",\"vishnu-2\":\"Vishnu-2\",\"you already reached downlod limit of this product\":\"You Already Reached Downlod Limit Of This Product\",\"vishnu-3\":\"Vishnu-3\",\"vishnu-4\":\"Vishnu-4\",\"undefined variable: existing_indexes\":\"Undefined Variable: Existing Indexes\",\"vishnu-5\":\"Vishnu-5\",\"vishnu-5 - test-1\":\"Vishnu-5 - Test-1\",\"vishnu-5 - test-2\":\"Vishnu-5 - Test-2\",\"vishnu-5 - test-3\":\"Vishnu-5 - Test-3\",\"add pages\":\"Add Pages\",\"this product is approved successfully\":\"This Product Is Approved Successfully\",\"add on\":\"Add On\",\"welcome_page_heading\":\"Welcome Page Heading\",\"welcome_page_sub_heading\":\"Welcome Page Sub Heading\",\"easy digital downloads\":\"Easy Digital Downloads\",\"welcome_page_sub_heading2\":\"Welcome Page Sub Heading2\",\"invalid setting\":\"Invalid Setting\",\"welcome_page_another_heading\":\"Welcome Page Another Heading\",\"products available from $1\":\"Products Available From $1\",\"offer_price\":\"Offer Price\",\"please login to access this page\":\"Please Login To Access This Page\",\"great_join_with_us\":\"Great Join With Us\",\"1\":\"1\"}', '2016-08-30 06:11:02', '2017-05-22 10:36:27');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `is_default_admin`, `phrases`, `created_at`, `updated_at`) VALUES
(16, 'French', 'french', 'FR', 0, 0, 0, '{\"languages\":\"Langues\",\"home\":\"Accueil\",\"create\":\"Cr\\u00e9er\",\"language\":\"La langue\",\"code\":\"Code\",\"default_language\":\"Langage par d\\u00e9faut\",\"action\":\"action\",\"are_you_sure\":\"\\u00cates-vous s\\u00fbr\",\"you_will_not_be_able_to_recover_this_record\":\"Vous ne pourrez pas r\\u00e9cup\\u00e9rer ce dossier\",\"yes\":\"Oui\",\"delete_it\":\"Supprime-le\",\"no\":\"Non\",\"cancel_please\":\"Annuler, s\'il vous pla\\u00eet\",\"deleted\":\"Supprim\\u00e9\",\"sorry\":\"Pardon\",\"cannot_delete_this_record_as\":\"Impossible de supprimer ce document en tant que\",\"your_record_has_been_deleted\":\"Votre dossier a \\u00e9t\\u00e9 supprim\\u00e9\",\"cancelled\":\"Annul\\u00e9\",\"your_record_is_safe\":\"Votre disque est s\\u00e9curis\\u00e9\",\"name\":\"pr\\u00e9nom\",\"phone_number\":\"Num\\u00e9ro de t\\u00e9l\\u00e9phone\",\"email\":\"Email\",\"message\":\"Message\",\"please_enter_your_message\":\"Entrez votre message s\'il vous plait\",\"products\":\"Des produits\",\"pages\":\"Pages\",\"my dashboard\":\"Mon tableau de bord\",\"logout\":\"Connectez - Out\",\"enable\":\"Activer\",\"set_default\":\"D\\u00e9finir par defaut\",\"disable\":\"D\\u00e9sactiver\",\"hope you enjoyed the shopping with us. visit again.\":\"J\'esp\\u00e8re que vous avez appr\\u00e9ci\\u00e9 les achats avec nous. Visitez encore.\",\"success\":\"Succ\\u00e8s\",\"login_here\":\"Connectez-vous ici\",\"go_to_my_account\":\"Acc\\u00e9der \\u00e0 mon Compte\",\"email_address\":\"Adresse e-mail\",\"password\":\"Mot de passe\",\"log_in\":\"S\'identifier\",\"dont_have_account?_create_now\":\"Vous n\'avez pas de compte? Cr\\u00e9er maintenant\",\"forgot_password?\":\"Mot de passe oubli\\u00e9?\",\"please_enter_email_address\":\"Entrez l\'adresse e-mail\",\"please_enter_valid_email_address\":\"Entrez une adresse \\u00e9lectronique valide\",\"please_enter_password\":\"Veuillez entrer le mot de passe\",\"contact_us\":\"Contactez nous\",\"jack\":\"Jack\",\"jack@jarvis.com\":\"Jack@jarvis.com\",\"send\":\"Envoyer\",\"about us\":\"\\u00c0 propos de nous\",\"login\":\"S\'identifier\",\"digisamaritan\":\"Digisamaritan\",\"useful links\":\"Liens utiles\",\"privacy and policy\":\"Politique de confidentialit\\u00e9 et politique\",\"terms & conditions\":\"termes et conditions\",\"about us footer\":\"\\u00c0 propos de nous Pied de page\",\"contact us\":\"Contactez nous\",\"dummy text\":\"Faux texte\",\"text one\":\"Text One\",\"text two\":\"Deuxi\\u00e8me texte\",\"text three\":\"Texte trois\",\"our services\":\"Nos services\",\"sales\":\"Ventes\",\"purchases\":\"Achats\",\"downloads\":\"T\\u00e9l\\u00e9chargements\",\"uploads\":\"Uploads\",\"services one\":\"Services One\",\"services two\":\"Services Deux\",\"contact\":\"Contact\",\"home_page_banner_heading\":\"Page d\'accueil En-t\\u00eate de la banni\\u00e8re\",\"home_page_banner_sub_heading\":\"Page d\'accueil Banner Sous-titre\",\"search_by_product\":\"Recherche par produit\",\"select\":\"S\\u00e9lectionner\",\"php scripts\":\"Php Scripts\",\"add-ons\":\"Compl\\u00e9ments\",\"calendars\":\"Calendriers\",\"countdowns\":\"Compte \\u00e0 rebours\",\"forms\":\"Formes\",\"vishnu-category\":\"Cat\\u00e9gorie Vishnu\",\"wordpress\":\"Wordpress\",\"advertising\":\"La publicit\\u00e9\",\"forums\":\"Forums\",\"galleries\":\"Galeries\",\"media\":\"M\\u00e9dias\",\"ecommerce\":\"Commerce \\u00e9lectronique\",\"jigoshop\":\"Jigoshop\",\"magento extensions\":\"Magento Extensions\",\"opencart\":\"Opencart\",\"oscommerce\":\"Oscommerce\",\" javascript\":\"Javascript\",\"prestashop\":\"Prestashop\",\"images and media\":\"Images et m\\u00e9dias\",\"loaders and uploaders\":\"Chargeurs et chargeurs\",\"css\":\"Css\",\"animations and effects\":\"Animations et effets\",\"buttons\":\"Boutons\",\"charts and graphs\":\"Graphiques et graphiques\",\"layouts\":\"Dispositions\",\"mobile\":\"Mobile\",\"android\":\"Android\",\"ios\":\"Ios\",\"native web\":\"Native Web\",\"titanium\":\"Titane\",\"html5\":\"Html5\",\"3d\":\"3d\",\"canvas\":\"Toile\",\"games\":\"Jeux\",\"libraries\":\"Biblioth\\u00e8ques\",\"skins\":\"Peaux\",\"bootstrap\":\"Bootstrap\",\"layers wp style kits\":\"Kits de styles de couches Wp\",\"miscellaneous\":\"Divers\",\"plugins\":\"Plugins\",\"concrete5\":\"B\\u00e9ton5\",\"drupal\":\"Drupal\",\"expression engine\":\"Expression Engine\",\"joomla\":\"Joomla\",\".net\":\".net\",\"content management\":\"Gestion de contenu\",\"marketing\":\"Commercialisation\",\"email templates\":\"Mod\\u00e8les d\'email\",\"instapage\":\"Instapage\",\"landing pages\":\"Pages d\'atterrissage\",\"pagewiz\":\"Pagewiz\",\"cms themes\":\"Cms Themes\",\"moodle\":\"Moodle\",\"mura\":\"Mura\",\"webflow\":\"Flux Web\",\"weebly\":\"Weebly\",\"muse templates\":\"Mod\\u00e8les de musiques\",\"corporate\":\"Entreprise\",\"creative\":\"Cr\\u00e9atif\",\"landing\":\"Atterrissage\",\"ui design\":\"Ui Design\",\"psd templates\":\"Mod\\u00e8les Psd\",\"popular psd templates\":\"Mod\\u00e8les Psd populaires\",\"sketch templates\":\"Mod\\u00e8les d\'esquisse\",\"popular sketch templates\":\"Mod\\u00e8les d\'esquisse populaires\",\"blogging\":\"Blogging\",\"portfolio\":\"Portefeuille\",\"ghost themes\":\"Th\\u00e8mes fant\\u00f4mes\",\"blogger\":\"Blogger\",\"blog\":\"Blog\",\"facebook templates\":\"Mod\\u00e8les Facebook\",\"business\":\"Entreprise\",\"magazine\":\"Magazine\",\"photography\":\"La photographie\",\"after effects project file\":\"Fichier du projet After Effects\",\"broadcast packages\":\"Forfaits de diffusion\",\"element 3d\":\"El\\u00e9ment 3d\",\"elements\":\"\\u00c9l\\u00e9ments\",\"infographics\":\"Infographie\",\"apple motion templates\":\"Apple Motion Templates\",\"logo stings\":\"Logo Stings\",\"openers\":\"Openers\",\"titles\":\"Titres\",\"motion graphics\":\"Motion Graphics\",\"backgrounds\":\"Fond d\'\\u00e9cran\",\"bugs\":\"Bogues\",\"interface effects\":\"Effets d\'interface\",\"lower thirds\":\"Lower Thirds\",\"stock footage\":\"Stock Footage\",\"buildings\":\"B\\u00e2timents\",\"construction\":\"Construction\",\"education\":\"\\u00c9ducation\",\"food\":\"Aliments\",\"cinema 4d templates\":\"Mod\\u00e8les Cinema 4d\",\"animated svgs\":\"Animated Svgs\",\"video displays\":\"Affichages vid\\u00e9o\",\"search\":\"Chercher\",\"get \":\"Obtenir\",\" for just \":\"Pour seulement\",\"this_offer_expires_on\":\"Cette offre expire\",\"days\":\"Journ\\u00e9es\",\"hours\":\"Heures\",\"mins\":\"Mins\",\"sec\":\"Seconde\",\"view_details\":\"Voir les d\\u00e9tails\",\"buy\":\"ACHETER\",\"more_offers\":\"Plus d\'offres\",\"popular\":\"Populaire\",\"featured\":\"En vedette\",\"latest\":\"Dernier\",\"freebies\":\"Freebies\",\"buy_now\":\"Acheter maintenant\",\"details\":\"D\\u00e9tails\",\"_empty_\":\"\",\"form generator \":\"G\\u00e9n\\u00e9rateur de formulaire\",\"1\":\"1\",\"fiverr script stats\":\"Fiverr Script Stats\",\"translation to \":\"Traduction \\u00e0\",\"view_more\":\"AFFICHER PLUS\",\"see_all_products\":\"Voir tous les produits\",\"most popular\":\"Le plus populaire\",\"categories\":\"Cat\\u00e9gories\",\"static pages\\/fo\":\"Pages statiques \\/ fo\",\"rating system\":\"Syst\\u00e8me d\'\\u00e9valuation\",\"video upload plugin\":\"Plugin de t\\u00e9l\\u00e9chargement vid\\u00e9o\",\"email address\":\"Adresse e-mail\",\"click here to select\":\"Cliquez ici pour s\\u00e9lectionner\",\"please enter email address\":\"Entrez l\'adresse e-mail\",\"please enter valid email address\":\"Entrez une adresse \\u00e9lectronique valide\",\"live demo\":\"Demo en direct\",\"add_to_cart\":\"Ajouter au panier\",\"share:\":\"Partager:\",\"duration\":\"Dur\\u00e9e\",\"about_author\":\"\\u00c0 propos de l\'auteur\",\"products : \":\"Des produits :\",\"licence_of_use\":\"Licence d\'utilisation\",\"product_info\":\"Information sur le produit\",\"technical_info\":\"Info technique\",\"related_products\":\"Produits connexes\",\"invalid_setting\":\"Param\\u00e8tre invalide\",\"record_updated_successfully\":\"Record Updated Successfully\",\"toggle navigation\":\"Toggle Navigation\",\"profile\":\"Profile\",\"sign out\":\"Sign Out\",\"online\":\"Online\",\"dashboard\":\"Dashboard\",\"users\":\"Users\",\"all\":\"All\",\"owners\":\"Owners\",\"admins\":\"Admins\",\"executives\":\"Executives\",\"vendors\":\"Vendors\",\"customers\":\"Customers\",\"add\":\"Add\",\"import\":\"Import\",\"list\":\"List\",\"coupons\":\"Coupons\",\"licences\":\"Licences\",\"templates\":\"Templates\",\"offers\":\"Offers\",\"payment_reports\":\"Payment Reports\",\"online_reports\":\"Online Reports\",\"offline_reports\":\"Offline Reports\",\"export\":\"Export\",\"free_bies\":\"Free Bies\",\"menus\":\"Menus\",\"settings\":\"Settings\",\"user_statistics\":\"User Statistics\",\"view_all\":\"View All\",\"total_sales\":\"Total Sales\",\"total_revenue\":\"Total Revenue\",\"categories_dashboard\":\"Categories Dashboard\",\"title\":\"Title\",\"sub-cats\":\"Sub-cats\",\"status\":\"Status\",\"j\'esp\\u00e8re que vous avez appr\\u00e9ci\\u00e9 les achats avec nous. visitez encore.\":\"J\'esp\\u00e8re Que Vous Avez Appr\\u00e9ci\\u00e9 Les Achats Avec Nous. Visitez Encore.\",\"dont_have_account ?_create_it_now\":\"Dont Have Account ? Create It Now\",\"edd market place\":\"Edd Market Place\",\"about\":\"About\",\"how it works\":\"How It Works\",\"all_payments\":\"All Payments\",\"product\":\"Product\",\"price\":\"Price\",\"owner_name\":\"Owner Name\",\"coupon_code\":\"Coupon Code\",\"discount\":\"Discount\",\"licence_name\":\"Licence Name\",\"licence_amount\":\"Licence Amount\",\"paid_amount\":\"Paid Amount\",\"payment_gateway\":\"Payment Gateway\",\"date\":\"Date\",\"customer_email\":\"Customer Email\",\"regular\":\"Regular\",\"all users\":\"All Users\",\"users_dashboard\":\"Users Dashboard\",\"role\":\"Role\",\"image\":\"Image\"}', '2017-04-15 09:59:42', '2017-05-22 10:36:27'),
(19, 'Arabic', 'arabic', 'AR', 1, 0, 0, '{\"languages\":\"\\u0627\\u0644\\u0644\\u063a\\u0627\\u062a\",\"home\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629\",\"create\":\"\\u062e\\u0644\\u0642\",\"language\":\"\\u0644\\u063a\\u0629\",\"code\":\"\\u0627\\u0644\\u0634\\u0641\\u0631\\u0629\",\"default_language\":\"\\u0627\\u0644\\u0644\\u063a\\u0629 \\u0627\\u0644\\u0627\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\\u0629\",\"action\":\"\\u0639\\u0645\\u0644\",\"are_you_sure\":\"\\u0647\\u0644 \\u0623\\u0646\\u062a \\u0648\\u0627\\u062b\\u0642\",\"you_will_not_be_able_to_recover_this_record\":\"\\u0644\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u0642\\u0627\\u062f\\u0631\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0633\\u062a\\u0639\\u0627\\u062f\\u0629 \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0633\\u062c\\u0644\",\"yes\":\"\\u0646\\u0639\\u0645 \\u0641\\u0639\\u0644\\u0627\",\"delete_it\":\"\\u0627\\u062d\\u0630\\u0641\\u0647\",\"no\":\"\\u0644\\u0627\",\"cancel_please\":\"\\u0625\\u0644\\u063a\\u0627\\u0621 \\u0645\\u0646 \\u0641\\u0636\\u0644\\u0643\",\"deleted\":\"\\u062a\\u0645 \\u0627\\u0644\\u062d\\u0630\\u0641\",\"sorry\":\"\\u0645\\u0639\\u0630\\u0631\\u0629\",\"cannot_delete_this_record_as\":\"\\u0644\\u0627 \\u064a\\u0645\\u0643\\u0646 \\u062d\\u0630\\u0641 \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0633\\u062c\\u0644 \\u0628\\u0627\\u0633\\u0645\",\"your_record_has_been_deleted\":\"\\u062a\\u0645 \\u062d\\u0630\\u0641 \\u0627\\u0644\\u0633\\u062c\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643\",\"cancelled\":\"\\u062a\\u0645 \\u0627\\u0644\\u0627\\u0644\\u063a\\u0627\\u0621\",\"your_record_is_safe\":\"\\u0627\\u0644\\u0633\\u062c\\u0644 \\u0627\\u0644\\u062e\\u0627\\u0635 \\u0628\\u0643 \\u0647\\u0648 \\u0622\\u0645\\u0646\",\"name\":\"\\u0627\\u0633\\u0645\",\"phone_number\":\"\\u0631\\u0642\\u0645 \\u0627\\u0644\\u0647\\u0627\\u062a\\u0641\",\"email\":\"\\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"message\":\"\\u0631\\u0633\\u0627\\u0644\\u0629\",\"please_enter_your_message\":\"\\u0623\\u062f\\u0631\\u062c \\u0631\\u0633\\u0627\\u0644\\u062a\\u0643 \\u0645\\u0646 \\u0641\\u0636\\u0644\\u0643\",\"products\":\"\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a\",\"pages\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0627\\u062a\",\"my_dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\",\"logout\":\"\\u0627\\u0644\\u062e\\u0631\\u0648\\u062c\",\"enable\":\"\\u062a\\u0645\\u0643\\u064a\\u0646\",\"disable\":\"\\u062a\\u0639\\u0637\\u064a\\u0644\",\"set_default\":\"\\u0627\\u0644\\u0648\\u0636\\u0639 \\u0627\\u0644\\u0625\\u0641\\u062a\\u0631\\u0627\\u0636\\u064a\",\"categories\":\"\\u0627\\u0644\\u0627\\u0642\\u0633\\u0627\\u0645\",\"buy_now\":\"\\u0627\\u0634\\u062a\\u0631\\u064a \\u0627\\u0644\\u0622\\u0646\",\"details\":\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\",\"email_address\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"send\":\"\\u0625\\u0631\\u0633\\u0627\\u0644\",\"dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u0642\\u064a\\u0627\\u062f\\u0629\",\"purchase_history\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0634\\u0631\\u0627\\u0621\",\"profile\":\"\\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"coupons\":\"\\u0643\\u0648\\u0628\\u0648\\u0646\\u0627\\u062a\",\"edit_account_information\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a \\u0627\\u0644\\u062d\\u0633\\u0627\\u0628\",\"first_name\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0627\\u0648\\u0644\",\"this_field_is_required\":\"\\u0647\\u0630\\u0647 \\u0627\\u0644\\u062e\\u0627\\u0646\\u0629 \\u0645\\u0637\\u0644\\u0648\\u0628\\u0647\",\"last_name\":\"\\u0627\\u0644\\u0643\\u0646\\u064a\\u0629\",\"facebook\":\"\\u0641\\u064a\\u0633 \\u0628\\u0648\\u0643\",\"twitter\":\"\\u062a\\u063a\\u0631\\u064a\\u062f\",\"pinterest\":\"\\u0628\\u064a\\u0646\\u062a\\u064a\\u0631\\u064a\\u0633\\u062a\",\"dribbble\":\"\\u062f\\u0631\\u064a\\u0628\\u0628\\u0644\",\"about_me\":\"\\u0639\\u0646\\u064a\",\"home_page_banner_heading\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629 \\u0628\\u0627\\u0646\\u0631 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646\",\"home_page_banner_sub_heading\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0629 \\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629 \\u0628\\u0627\\u0646\\u0631 \\u0633\\u0648\\u0628 \\u0647\\u064a\\u062f\\u064a\\u0646\\u063a\",\"search by product\":\"\\u0627\\u0644\\u0628\\u062d\\u062b \\u062d\\u0633\\u0628 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"search\":\"\\u0628\\u062d\\u062b\",\"get \":\"\\u0627\\u062d\\u0635\\u0644 \\u0639\\u0644\\u0649\",\" for just \":\"\\u0641\\u0642\\u0637 \\u0644\",\"this offer expires on\":\"\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0639\\u0631\\u0636 \\u064a\\u0646\\u062a\\u0647\\u064a \\u0641\\u064a\",\"days\":\"\\u0623\\u064a\\u0627\\u0645\",\"hours\":\"\\u0633\\u0627\\u0639\\u0627\\u062a\",\"mins\":\"\\u062f\\u0642\\u064a\\u0642\\u0629\",\"sec\":\"\\u062b\\u0627\\u0646\\u064a\\u0629\",\"view details\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\",\"buy \":\"\\u064a\\u0634\\u062a\\u0631\\u0649\",\"popular\":\"\\u062c\\u0645\\u0639\",\"featured\":\"\\u0645\\u062a\\u0645\\u064a\\u0632\",\"latest\":\"\\u0622\\u062e\\u0631\",\"freebies\":\"\\u0627\\u0644\\u0645\\u062c\\u0627\\u0646\\u064a\\u0629\",\"buy now\":\"\\u0627\\u0634\\u062a\\u0631\\u064a \\u0627\\u0644\\u0622\\u0646\",\"see all products\":\"\\u0627\\u0646\\u0638\\u0631 \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a\",\"most popular\":\"\\u0627\\u0644\\u0623\\u0643\\u062b\\u0631 \\u0634\\u0639\\u0628\\u064a\\u0629\",\"email address\":\"\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"click here to select\":\"\\u0627\\u0646\\u0642\\u0631 \\u0647\\u0646\\u0627 \\u0644\\u062a\\u062d\\u062f\\u064a\\u062f\",\"please enter email address\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"please enter valid email address\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0628\\u0631\\u064a\\u062f \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0635\\u0627\\u0644\\u062d\",\"login\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\",\"no products found\":\"\\u0644\\u0645 \\u064a\\u062a\\u0645 \\u0627\\u0644\\u0639\\u062b\\u0648\\u0631 \\u0639\\u0644\\u0649 \\u0645\\u0646\\u062a\\u062c\\u0627\\u062a\",\"please select\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u062f\",\"cart_details\":\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0639\\u0631\\u0628\\u0629\",\"cart\":\"\\u0639\\u0631\\u0628\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642\",\"your cart\":\"\\u0639\\u0631\\u0628\\u062a\\u0643\",\"image\":\"\\u0635\\u0648\\u0631\\u0629\",\"product name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"product price\":\"\\u0633\\u0639\\u0631 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"options\":\"\\u062e\\u064a\\u0627\\u0631\\u0627\\u062a\",\"continue shopping\":\"\\u0645\\u0648\\u0627\\u0635\\u0644\\u0629 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642\",\"total cart\":\"\\u0625\\u062c\\u0645\\u0627\\u0644\\u064a \\u0627\\u0644\\u0633\\u0644\\u0629\",\"products price :\":\"\\u0623\\u0633\\u0639\\u0627\\u0631 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a:\",\"tax :\":\"\\u0636\\u0631\\u064a\\u0628\\u0629:\",\"support fee :\":\"\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u062f\\u0639\\u0645:\",\"total price :\":\"\\u0627\\u0644\\u0633\\u0639\\u0631 \\u0627\\u0644\\u0643\\u0644\\u064a :\",\"check out\":\"\\u0627\\u0644\\u062f\\u0641\\u0639\",\"all_offers\":\"\\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0639\\u0631\\u0648\\u0636\",\"this offer expires on:\":\"\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0639\\u0631\\u0636 \\u064a\\u0646\\u062a\\u0647\\u064a \\u0641\\u064a:\",\"add to cart\":\"\\u0623\\u0636\\u0641 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u0633\\u0644\\u0629\",\"share:\":\"\\u0634\\u0627\\u0631\\u0643:\",\"download\":\"\\u062a\\u062d\\u0645\\u064a\\u0644\",\"about author\":\"\\u0646\\u0628\\u0630\\u0629 \\u0639\\u0646 \\u0627\\u0644\\u0643\\u0627\\u062a\\u0628\",\"products : \":\"\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a :\",\"view_details\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\",\"product info\":\"\\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"downloads\":\"\\u0627\\u0644\\u062a\\u0646\\u0632\\u064a\\u0644\\u0627\\u062a\",\"related products\":\"\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a \\u0630\\u0627\\u062a \\u0635\\u0644\\u0647\",\"invalid_setting\":\"\\u0625\\u0639\\u062f\\u0627\\u062f \\u063a\\u064a\\u0631 \\u0635\\u0627\\u0644\\u062d\",\"view_more\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0645\\u0632\\u064a\\u062f\",\"login_here\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644 \\u0647\\u0646\\u0627\",\"go to my account\":\"\\u0627\\u0630\\u0647\\u0628 \\u0625\\u0644\\u0649 \\u062d\\u0633\\u0627\\u0628\\u064a\",\"log in\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\",\"dont have account? create now\":\"\\u0644\\u0627 \\u062a\\u0645\\u0644\\u0643 \\u062d\\u0633\\u0627\\u0628\\u061f \\u0627\\u0635\\u0646\\u0639 \\u0627\\u0644\\u0627\\u0646\",\"forgot password?\":\"\\u0647\\u0644 \\u0646\\u0633\\u064a\\u062a \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\\u061f\",\"please enter password\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"hope you enjoyed the shopping with us. visit again.\":\"\\u0622\\u0645\\u0644 \\u0623\\u0646 \\u062a\\u0633\\u062a\\u0645\\u062a\\u0639 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0645\\u0639\\u0646\\u0627. \\u0632\\u0648\\u0631\\u0646\\u064a \\u0645\\u0631\\u0647 \\u0627\\u062e\\u0631\\u0649.\",\"success\":\"\\u0646\\u062c\\u0627\\u062d\",\"about us\":\"\\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a \\u0639\\u0646\\u0627\",\"digisamaritan\":\"Digisamaritan\",\"useful links\":\"\\u0631\\u0648\\u0627\\u0628\\u0637 \\u0645\\u0641\\u064a\\u062f\\u0629\",\"\\u0622\\u0645\\u0644 \\u0623\\u0646 \\u062a\\u0633\\u062a\\u0645\\u062a\\u0639 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0645\\u0639\\u0646\\u0627. \\u0632\\u0648\\u0631\\u0646\\u064a \\u0645\\u0631\\u0647 \\u0627\\u062e\\u0631\\u0649.\":\"\\u0622\\u0645\\u0644 \\u0623\\u0646 \\u062a\\u0633\\u062a\\u0645\\u062a\\u0639 \\u0627\\u0644\\u062a\\u0633\\u0648\\u0642 \\u0645\\u0639\\u0646\\u0627. \\u0632\\u0648\\u0631\\u0646\\u064a \\u0645\\u0631\\u0647 \\u0627\\u062e\\u0631\\u0649.\",\"privacy and policy\":\"\\u0627\\u0644\\u062e\\u0635\\u0648\\u0635\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0633\\u064a\\u0627\\u0633\\u0629\",\"terms & conditions\":\"\\u0627\\u0644\\u0628\\u0646\\u0648\\u062f \\u0648 \\u0627\\u0644\\u0638\\u0631\\u0648\\u0641\",\"about us footer\":\"\\u062d\\u0648\\u0644 \\u062a\\u0630\\u064a\\u064a\\u0644 \\u0627\\u0644\\u0635\\u0641\\u062d\\u0629\",\"contact us\":\"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627\",\"dummy text\":\"\\u0646\\u0635 \\u0627\\u0644\\u062f\\u0645\\u064a\\u0629\",\"text one\":\"\\u0627\\u0644\\u0646\\u0635 \\u0627\\u0644\\u0623\\u0648\\u0644\",\"text two\":\"\\u0627\\u0644\\u0646\\u0635 \\u0627\\u0644\\u062b\\u0627\\u0646\\u064a\",\"text three\":\"\\u0627\\u0644\\u0646\\u0635 \\u0627\\u0644\\u062b\\u0627\\u0644\\u062b\",\"our services\":\"\\u062e\\u062f\\u0645\\u0627\\u062a\\u0646\\u0627\",\"sales\":\"\\u0645\\u0628\\u064a\\u0639\\u0627\\u062a\",\"purchases\":\"\\u0627\\u0644\\u0645\\u0634\\u062a\\u0631\\u064a\\u0627\\u062a\",\"uploads\":\"\\u062a\\u062d\\u0645\\u064a\\u0644\",\"services one\":\"\\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0648\\u0627\\u0646\",\"services two\":\"\\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u062a\\u0648\",\"contact\":\"\\u0627\\u062a\\u0635\\u0644\",\"contact_us\":\"Contact Us\",\"jack\":\"Jack\",\"jack@jarvis.com\":\"Jack@jarvis.com\",\"go_to_my_account\":\"\\u0627\\u0630\\u0647\\u0628 \\u0625\\u0644\\u0649 \\u062d\\u0633\\u0627\\u0628\\u064a\",\"log_in\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644\",\"dont_have_account?_create_now\":\"\\u0644\\u0627 \\u062a\\u0645\\u0644\\u0643 \\u062d\\u0633\\u0627\\u0628\\u061f \\u0627\\u0635\\u0646\\u0639 \\u0627\\u0644\\u0627\\u0646\",\"forgot_password?\":\"\\u0647\\u0644 \\u0646\\u0633\\u064a\\u062a \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\\u061f\",\"please_enter_email_address\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"please_enter_valid_email_address\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0628\\u0631\\u064a\\u062f \\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a \\u0635\\u0627\\u0644\\u062d\",\"please_enter_password\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"reset password\":\"\\u0625\\u0639\\u0627\\u062f\\u0629 \\u062a\\u0639\\u064a\\u064a\\u0646 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"register\":\"\\u062a\\u0633\\u062c\\u064a\\u0644\",\"great, join with us\":\"\\u0639\\u0638\\u064a\\u0645\\u060c \\u0627\\u0646\\u0636\\u0645 \\u0625\\u0644\\u064a\\u0646\\u0627\",\"click\":\"\\u0627\\u0646\\u0642\\u0631\",\"here\":\"\\u0647\\u0646\\u0627\",\"to register as vendor\":\"\\u0644\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0643\\u0645\\u0648\\u0631\\u062f\",\"first name\":\"\\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0627\\u0648\\u0644\",\"last name\":\"\\u0627\\u0644\\u0643\\u0646\\u064a\\u0629\",\"password\":\"\\u0643\\u0644\\u0645\\u0647 \\u0627\\u0644\\u0633\\u0631\",\"re-enter password\":\"\\u0625\\u0639\\u0627\\u062f\\u0629 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"by creating an account you agree to our \":\"\\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0625\\u0646\\u0634\\u0627\\u0621 \\u062d\\u0633\\u0627\\u0628 \\u062a\\u0648\\u0627\\u0641\\u0642 \\u0639\\u0644\\u0649 \\u0644\\u062f\\u064a\\u0646\\u0627\",\"terms and conditions\":\"\\u0627\\u0644\\u0623\\u062d\\u0643\\u0627\\u0645 \\u0648\\u0627\\u0644\\u0634\\u0631\\u0648\\u0637\",\"and our\":\"\\u0648 \\u0644\\u0646\\u0627\",\"privacy policy\":\"\\u0633\\u064a\\u0627\\u0633\\u0629 \\u0627\\u0644\\u062e\\u0635\\u0648\\u0635\\u064a\\u0629\",\"already having account?\":\"\\u0647\\u0644 \\u0644\\u062f\\u064a\\u0643 \\u062d\\u0633\\u0627\\u0628 \\u0628\\u0627\\u0644\\u0641\\u0639\\u0644\\u061f\",\"login here\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u062f\\u062e\\u0648\\u0644 \\u0647\\u0646\\u0627\",\"please enter first name\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0623\\u0648\\u0644\",\"please accept the terms and conditions\":\"\\u064a\\u0631\\u062c\\u0649 \\u0642\\u0628\\u0648\\u0644 \\u0627\\u0644\\u0634\\u0631\\u0648\\u0637 \\u0648\\u0627\\u0644\\u0623\\u062d\\u0643\\u0627\\u0645\",\"password should be at least 6 characters\":\"\\u064a\\u062c\\u0628 \\u0623\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0623\\u0642\\u0644 6 \\u0623\\u062d\\u0631\\u0641\",\"please enter password again to confirm\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u0645\\u0631\\u0629 \\u0623\\u062e\\u0631\\u0649 \\u0644\\u0644\\u062a\\u0623\\u0643\\u064a\\u062f\",\"password and re-enter password not same\":\"\\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u0648\\u0625\\u0639\\u0627\\u062f\\u0629 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631 \\u0644\\u064a\\u0633\\u062a \\u0647\\u064a \\u0646\\u0641\\u0633\\u0647\\u0627\",\"greate_join_with_us\":\"\\u063a\\u0631\\u064a\\u062a \\u0627\\u0644\\u0627\\u0646\\u0636\\u0645\\u0627\\u0645 \\u0645\\u0639\\u0646\\u0627\",\"to_register_as_vendor\":\"\\u0644\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0643\\u0645\\u0648\\u0631\\u062f\",\"re-enter_password\":\"\\u0625\\u0639\\u0627\\u062f\\u0629 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0643\\u0644\\u0645\\u0629 \\u0627\\u0644\\u0645\\u0631\\u0648\\u0631\",\"by_creating_an_account_you_agree_to_our \":\"\\u0645\\u0646 \\u062e\\u0644\\u0627\\u0644 \\u0625\\u0646\\u0634\\u0627\\u0621 \\u062d\\u0633\\u0627\\u0628 \\u062a\\u0648\\u0627\\u0641\\u0642 \\u0639\\u0644\\u0649 \\u0644\\u062f\\u064a\\u0646\\u0627\",\"terms_and_conditions\":\"\\u0627\\u0644\\u0623\\u062d\\u0643\\u0627\\u0645 \\u0648\\u0627\\u0644\\u0634\\u0631\\u0648\\u0637\",\"privacy_policy\":\"\\u0633\\u064a\\u0627\\u0633\\u0629 \\u0627\\u0644\\u062e\\u0635\\u0648\\u0635\\u064a\\u0629\",\"already_having_account?\":\"\\u0647\\u0644 \\u0644\\u062f\\u064a\\u0643 \\u062d\\u0633\\u0627\\u0628 \\u0628\\u0627\\u0644\\u0641\\u0639\\u0644\\u061f\",\"please_enter_first_name\":\"\\u0627\\u0644\\u0631\\u062c\\u0627\\u0621 \\u0625\\u062f\\u062e\\u0627\\u0644 \\u0627\\u0644\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0623\\u0648\\u0644\",\"please_accept_the_terms_and_conditions\":\"\\u064a\\u0631\\u062c\\u0649 \\u0642\\u0628\\u0648\\u0644 \\u0627\\u0644\\u0634\\u0631\\u0648\\u0637 \\u0648\\u0627\\u0644\\u0623\\u062d\\u0643\\u0627\\u0645\",\"amount\":\"\\u0643\\u0645\\u064a\\u0629\",\"user_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"paid_amount\":\"\\u0627\\u0644\\u0645\\u0628\\u0644\\u063a \\u0627\\u0644\\u0645\\u062f\\u0641\\u0648\\u0639\",\"payment_gateway\":\"\\u0628\\u0648\\u0627\\u0628\\u0629 \\u0627\\u0644\\u062f\\u0641\\u0639\",\"updated_at\":\"\\u062a\\u0645 \\u0627\\u0644\\u062a\\u062d\\u062f\\u064a\\u062b \\u0641\\u064a\",\"payment_status\":\"\\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u0633\\u062f\\u0627\\u062f\",\"product_details\":\"\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"ok\":\"\\u062d\\u0633\\u0646\\u0627\",\"edit account information\":\"\\u062a\\u062d\\u0631\\u064a\\u0631 \\u0645\\u0639\\u0644\\u0648\\u0645\\u0627\\u062a \\u0627\\u0644\\u062d\\u0633\\u0627\\u0628\",\"edit billing address\":\"\\u062a\\u0639\\u062f\\u064a\\u0644 \\u0639\\u0646\\u0648\\u0627\\u0646 \\u0625\\u0631\\u0633\\u0627\\u0644 \\u0627\\u0644\\u0641\\u0648\\u0627\\u062a\\u064a\\u0631\",\"address line1\":\"\\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 \\u0627\\u0644\\u0623\\u0648\\u0644\",\"address line2\":\"\\u0633\\u0637\\u0631 \\u0627\\u0644\\u0639\\u0646\\u0648\\u0627\\u0646 2\",\"city\":\"\\u0645\\u062f\\u064a\\u0646\\u0629\",\"zip code\":\"\\u0627\\u0644\\u0631\\u0645\\u0632 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f\\u064a\",\"state\\/province\":\"\\u0627\\u0644\\u062f\\u0648\\u0644\\u0629 \\/ \\u0627\\u0644\\u0645\\u0642\\u0627\\u0637\\u0639\\u0629\",\"country\":\"\\u0628\\u0644\\u062f\",\"file_type_not_allowed\":\"\\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0644\\u0645\\u0637\\u0628\\u0648\\u0639 \\u0633\\u0631\\u064a\",\"admin_commission : \":\"\\u0644\\u062c\\u0646\\u0629 \\u0627\\u0644\\u0645\\u0634\\u0631\\u0641:\",\"title\":\"\\u0639\\u0646\\u0648\\u0627\\u0646\",\"discount_type\":\"\\u0646\\u0648\\u0639 \\u0627\\u0644\\u062e\\u0635\\u0645\",\"value\":\"\\u0627\\u0644\\u0642\\u064a\\u0645\\u0629\",\"minimum_amount\":\"\\u0627\\u0642\\u0644 \\u0645\\u0628\\u0644\\u063a\",\"start_date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0628\\u062f\\u0621\",\"end_date\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0627\\u0646\\u062a\\u0647\\u0627\\u0621\",\"status\":\"\\u0627\\u0644\\u062d\\u0627\\u0644\\u0629\",\"create_message\":\"\\u0625\\u0646\\u0634\\u0627\\u0621 \\u0631\\u0633\\u0627\\u0644\\u0629\",\"inbox\":\"\\u0635\\u0646\\u062f\\u0648\\u0642 \\u0627\\u0644\\u0648\\u0627\\u0631\\u062f\",\"compose\":\"\\u0645\\u0624\\u0644\\u0641 \\u0645\\u0648\\u0633\\u064a\\u0642\\u0649\",\"sorry_no_messages_available\":\"\\u0639\\u0630\\u0631\\u0627\\u060c \\u0644\\u0627 \\u062a\\u0648\\u062c\\u062f \\u0631\\u0633\\u0627\\u0626\\u0644 \\u0645\\u062a\\u0627\\u062d\\u0629\",\"purchase history\":\"\\u062a\\u0627\\u0631\\u064a\\u062e \\u0634\\u0631\\u0627\\u0621\",\"upload_purchases\":\"\\u062a\\u062d\\u0645\\u064a\\u0644 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0634\\u0631\\u0627\\u0621\",\"about_me_few_words\":\"\\u0639\\u0646\\u064a \\u0643\\u0644\\u0645\\u0627\\u062a \\u0642\\u0644\\u064a\\u0644\\u0629\",\"profile image\":\"\\u0635\\u0648\\u0631\\u0629 \\u0627\\u0644\\u0645\\u0644\\u0641 \\u0627\\u0644\\u0634\\u062e\\u0635\\u064a\",\"add\":\"\\u0625\\u0636\\u0627\\u0641\\u0629\",\"import\":\"\\u0627\\u0633\\u062a\\u064a\\u0631\\u0627\\u062f\",\"product_owner\":\"\\u0645\\u0627\\u0644\\u0643 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"price\":\"\\u0627\\u0644\\u0633\\u0639\\u0631\",\"approve_status\":\"\\u0627\\u0644\\u0645\\u0648\\u0627\\u0641\\u0642\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u062d\\u0627\\u0644\\u0629\",\"are_you_sure_to_make_approve_this_product\":\"\\u0647\\u0644 \\u0623\\u0646\\u062a \\u0645\\u062a\\u0623\\u0643\\u062f \\u0645\\u0646 \\u062c\\u0639\\u0644 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0641\\u0642\\u0629 \\u0639\\u0644\\u0649 \\u0647\\u0630\\u0627 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"search_by_product\":\"\\u0627\\u0644\\u0628\\u062d\\u062b \\u062d\\u0633\\u0628 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"select\":\"\\u062a\\u062d\\u062f\\u064a\\u062f\",\"php scripts\":\"\\u0641\\u0628 \\u0633\\u0643\\u0631\\u064a\\u0628\\u062a\\u0633\",\"add-ons\":\"\\u0625\\u0636\\u0627\\u0641\\u0627\\u062a\",\"calendars\":\"\\u0627\\u0644\\u062a\\u0642\\u0648\\u064a\\u0645\\u0627\\u062a\",\"countdowns\":\"\\u0627\\u0644\\u0639\\u062f \\u0627\\u0644\\u062a\\u0646\\u0627\\u0632\\u0644\\u064a \\u0644\",\"forms\":\"\\u0625\\u0633\\u062a\\u0645\\u0627\\u0631\\u0627\\u062a\",\"vishnu-category\":\"\\u0641\\u064a\\u0634\\u0646\\u0648 \\u0641\\u0626\\u0629\",\"wordpress\":\"\\u0648\\u0648\\u0631\\u062f\",\"advertising\":\"\\u0625\\u0639\\u0644\\u0627\\u0646\",\"forums\":\"\\u0627\\u0644\\u0645\\u0646\\u062a\\u062f\\u064a\\u0627\\u062a\",\"galleries\":\"\\u0627\\u0644\\u0645\\u0639\\u0627\\u0631\\u0636\",\"media\":\"\\u0648\\u0633\\u0627\\u0626\\u0644 \\u0627\\u0644\\u0625\\u0639\\u0644\\u0627\\u0645\",\"ecommerce\":\"\\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\u0629\",\"jigoshop\":\"Jigoshop\",\"magento extensions\":\"\\u0645\\u0644\\u062d\\u0642\\u0627\\u062a \\u0627\\u0644\\u0645\\u0627\\u062c\\u0646\\u062a\\u0648\",\"opencart\":\"Opencart\",\"oscommerce\":\"\\u0628\\u0648\\u0631\\u0635\\u0629 \\u0645\\u0635\\u0631\",\" javascript\":\"\\u062c\\u0627\\u0641\\u0627 \\u0633\\u0643\\u0631\\u064a\\u0628\\u062a\",\"prestashop\":\"\\u0628\\u0631\\u064a\\u0633\\u062a\\u0627\\u0634\\u0648\\u0628\",\"images and media\":\"\\u0627\\u0644\\u0635\\u0648\\u0631 \\u0648\\u0627\\u0644\\u0625\\u0639\\u0644\\u0627\\u0645\",\"loaders and uploaders\":\"\\u0644\\u0648\\u0627\\u062f\\u0631 \\u0648\\u062a\\u062d\\u0645\\u064a\\u0644\",\"css\":\"\\u0627\\u0644\\u0645\\u063a\\u0644\\u0642\",\"animations and effects\":\"\\u0627\\u0644\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0645\\u062a\\u062d\\u0631\\u0643\\u0629 \\u0648\\u0627\\u0644\\u0622\\u062b\\u0627\\u0631\",\"buttons\":\"\\u0648\\u0635\\u0641\\u062a\",\"charts and graphs\":\"\\u0627\\u0644\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u064a\\u0629\",\"layouts\":\"\\u062a\\u062e\\u0637\\u064a\\u0637\\u0627\\u062a\",\"mobile\":\"\\u0627\\u0644\\u062a\\u0644\\u064a\\u0641\\u0648\\u0646 \\u0627\\u0644\\u0645\\u062d\\u0645\\u0648\\u0644\",\"android\":\"\\u0630\\u0643\\u0631\\u064a \\u0627\\u0644\\u0645\\u0638\\u0647\\u0631\",\"ios\":\"\\u0625\\u064a\\u0648\\u0633\",\"native web\":\"\\u0648\\u064a\\u0628 \\u0627\\u0644\\u0623\\u0635\\u0644\\u064a\\u0629\",\"titanium\":\"\\u0627\\u0644\\u062a\\u064a\\u062a\\u0627\\u0646\\u064a\\u0648\\u0645\",\"html5\":\"HTML5\",\"3d\":\"3D\",\"canvas\":\"\\u0642\\u0645\\u0627\\u0634\",\"games\":\"\\u0623\\u0644\\u0639\\u0627\\u0628\",\"libraries\":\"\\u0627\\u0644\\u0645\\u0643\\u062a\\u0628\\u0627\\u062a\",\"skins\":\"\\u062c\\u0644\\u0648\\u062f\",\"bootstrap\":\"\\u0627\\u0644\\u062a\\u0645\\u0647\\u064a\\u062f\",\"layers wp style kits\":\"\\u0637\\u0628\\u0642\\u0627\\u062a \\u0648\\u0628 \\u0646\\u0645\\u0637 \\u0645\\u062c\\u0645\\u0648\\u0639\\u0627\\u062a\",\"miscellaneous\":\"\\u0645\\u062a\\u0646\\u0648\\u0639\",\"plugins\":\"\\u0627\\u0644\\u0625\\u0636\\u0627\\u0641\\u0627\\u062a\",\"concrete5\":\"Concrete5\",\"drupal\":\"\\u062f\\u0631\\u0648\\u0628\\u0627\\u0644\",\"expression engine\":\"\\u0645\\u062d\\u0631\\u0643 \\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631\",\"joomla\":\"\\u062c\\u0645\\u0644\\u0629\",\".net\":\".\\u0634\\u0628\\u0643\\u0629\",\"content management\":\"\\u0627\\u062f\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0648\\u0649\",\"marketing\":\"\\u062a\\u0633\\u0648\\u064a\\u0642\",\"email templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0627\\u0644\\u0628\\u0631\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\",\"instapage\":\"Instapage\",\"landing pages\":\"\\u0627\\u0644\\u0635\\u0641\\u062d\\u0627\\u062a \\u0627\\u0644\\u0645\\u0642\\u0635\\u0648\\u062f\\u0629\",\"pagewiz\":\"Pagewiz\",\"cms themes\":\"\\u0643\\u0645\\u0633 \\u062b\\u064a\\u0645\\u0627\\u062a\",\"moodle\":\"\\u0645\\u0648\\u0648\\u062f\\u0644\",\"mura\":\"\\u0645\\u0648\\u0631\\u0627\",\"webflow\":\"Webflow\",\"weebly\":\"W \\u062b ebly\",\"muse templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0645\\u0648\\u0633\\u0649\",\"corporate\":\"\\u0627\\u0644\\u0634\\u0631\\u0643\\u0627\\u062a\",\"creative\":\"\\u062e\\u0644\\u0627\\u0642\",\"landing\":\"\\u0647\\u0628\\u0648\\u0637\",\"ui design\":\"\\u062a\\u0635\\u0645\\u064a\\u0645 \\u0623\\u0648\\u064a\",\"psd templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0628\\u0633\\u062f\",\"popular psd templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0628\\u0633\\u062f \\u0627\\u0644\\u0634\\u0639\\u0628\\u064a\\u0629\",\"sketch templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0631\\u0633\\u0645\",\"popular sketch templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0631\\u0633\\u0645 \\u0634\\u0639\\u0628\\u064a\\u0629\",\"blogging\":\"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0627\\u062a\",\"portfolio\":\"\\u0645\\u062d\\u0641\\u0638\\u0629\",\"ghost themes\":\"\\u0634\\u0628\\u062d \\u0627\\u0644\\u0645\\u0648\\u0636\\u0648\\u0639\\u0627\\u062a\",\"blogger\":\"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\",\"blog\":\"\\u0645\\u062f\\u0648\\u0646\\u0629\",\"facebook templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0627\\u0644\\u0641\\u064a\\u0633\\u0628\\u0648\\u0643\",\"business\":\"\\u0627\\u0639\\u0645\\u0627\\u0644\",\"magazine\":\"\\u0645\\u062c\\u0644\\u0629\",\"photography\":\"\\u0627\\u0644\\u062a\\u0635\\u0648\\u064a\\u0631\",\"after effects project file\":\"\\u0628\\u0639\\u062f \\u0645\\u0634\\u0631\\u0648\\u0639 \\u0645\\u0644\\u0641 \\u0627\\u0644\\u0622\\u062b\\u0627\\u0631\",\"broadcast packages\":\"\\u062d\\u0632\\u0645 \\u0627\\u0644\\u0628\\u062b\",\"element 3d\":\"\\u0627\\u0644\\u0639\\u0646\\u0635\\u0631\\u060c 3d\",\"elements\":\"\\u0639\\u0646\\u0627\\u0635\\u0631\",\"infographics\":\"\\u0627\\u0644\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0628\\u064a\\u0627\\u0646\\u064a\\u0629\",\"apple motion templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628 \\u0627\\u0644\\u062d\\u0631\\u0643\\u0629 \\u0623\\u0628\\u0644\",\"logo stings\":\"\\u0627\\u0644\\u0634\\u0639\\u0627\\u0631 \\u0627\\u0644\\u0634\\u0639\\u0627\\u0631\",\"openers\":\"\\u0627\\u0644\\u0641\\u062a\\u0627\\u062d\\u0627\\u062a\",\"titles\":\"\\u0627\\u0644\\u0639\\u0646\\u0627\\u0648\\u064a\\u0646\",\"motion graphics\":\"\\u0627\\u0644\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0645\\u062a\\u062d\\u0631\\u0643\\u0629\",\"backgrounds\":\"\\u062e\\u0644\\u0641\\u064a\\u0627\\u062a\",\"bugs\":\"\\u0627\\u0644\\u0628\\u0642\",\"interface effects\":\"\\u0622\\u062b\\u0627\\u0631 \\u0648\\u0627\\u062c\\u0647\\u0629\",\"lower thirds\":\"\\u0627\\u0644\\u062b\\u0644\\u062b \\u0627\\u0644\\u0633\\u0641\\u0644\\u0649\",\"stock footage\":\"\\u0627\\u0631\\u0634\\u064a\\u0641 \\u0627\\u0644\\u0641\\u064a\\u062f\\u064a\\u0648\",\"buildings\":\"\\u0627\\u0644\\u0628\\u0646\\u0627\\u064a\\u0627\\u062a\",\"construction\":\"\\u0627\\u0639\\u0645\\u0627\\u0644 \\u0628\\u0646\\u0627\\u0621\",\"education\":\"\\u0627\\u0644\\u062a\\u0639\\u0644\\u064a\\u0645\",\"food\":\"\\u0637\\u0639\\u0627\\u0645\",\"cinema 4d templates\":\"\\u0633\\u064a\\u0646\\u0645\\u0627 4D \\u0642\\u0648\\u0627\\u0644\\u0628\",\"animated svgs\":\"\\u0627\\u0644\\u0631\\u0633\\u0648\\u0645 \\u0627\\u0644\\u0645\\u062a\\u062d\\u0631\\u0643\\u0629 \\u0633\\u0641\\u063a\\u0633\",\"video displays\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0641\\u064a\\u062f\\u064a\\u0648\",\"this_offer_expires_on\":\"\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0639\\u0631\\u0636 \\u064a\\u0646\\u062a\\u0647\\u064a \\u0641\\u064a\",\"buy\":\"\\u064a\\u0634\\u062a\\u0631\\u0649\",\"more_offers\":\"\\u0627\\u0644\\u0645\\u0632\\u064a\\u062f \\u0645\\u0646 \\u0627\\u0644\\u0639\\u0631\\u0648\\u0636\",\"_empty_\":\"\",\"form generator \":\"\\u0645\\u0648\\u0644\\u062f \\u0627\\u0644\\u0646\\u0645\\u0648\\u0630\\u062c\",\"1\":\"1\",\"fiverr script stats\":\"\\u0641\\u064a\\u0641\\u064a\\u0631 \\u0633\\u0643\\u0631\\u064a\\u0628\\u062a \\u0633\\u062a\\u0627\\u062a\\u0633\",\"translation to \":\"\\u062a\\u0631\\u062c\\u0645\\u0629 \\u0625\\u0644\\u0649\",\"see_all_products\":\"\\u0639\\u0631\\u0636 \\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a\",\"static pages\\/fo\":\"\\u0635\\u0641\\u062d\\u0627\\u062a \\u062b\\u0627\\u0628\\u062a\\u0629 \\/ \\u0641\\u0648\",\"rating system\":\"\\u0646\\u0638\\u0627\\u0645 \\u0627\\u0644\\u062a\\u0642\\u064a\\u064a\\u0645\",\"video upload plugin\":\"\\u062a\\u062d\\u0645\\u064a\\u0644 \\u0627\\u0644\\u0641\\u064a\\u062f\\u064a\\u0648 \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\",\"record_updated_successfully\":\"\\u062a\\u0645 \\u062a\\u062d\\u062f\\u064a\\u062b \\u0627\\u0644\\u0633\\u062c\\u0644 \\u0628\\u0646\\u062c\\u0627\\u062d\",\"toggle navigation\":\"\\u062a\\u0628\\u062f\\u064a\\u0644 \\u0627\\u0644\\u0645\\u0644\\u0627\\u062d\\u0629\",\"sign out\":\"\\u062e\\u0631\\u0648\\u062c\",\"online\":\"\\u0639\\u0628\\u0631 \\u0627\\u0644\\u0627\\u0646\\u062a\\u0631\\u0646\\u062a\",\"users\":\"\\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"all\":\"\\u0627\\u0644\\u0643\\u0644\",\"owners\":\"\\u0623\\u0635\\u062d\\u0627\\u0628\",\"admins\":\"\\u0645\\u062f\\u0631\\u0627\\u0621\",\"executives\":\"\\u0627\\u0644\\u0645\\u062f\\u064a\\u0631\\u064a\\u0646\",\"vendors\":\"\\u0627\\u0644\\u0628\\u0627\\u0639\\u0629\",\"customers\":\"\\u0627\\u0644\\u0632\\u0628\\u0627\\u0626\\u0646\",\"list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629\",\"licences\":\"\\u062a\\u0631\\u0627\\u062e\\u064a\\u0635\",\"templates\":\"\\u0642\\u0648\\u0627\\u0644\\u0628\",\"offers\":\"\\u0639\\u0631\\u0648\\u0636\",\"payment_reports\":\"\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0627\\u0644\\u062f\\u0641\\u0639\",\"online_reports\":\"\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u0639\\u0628\\u0631 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0631\\u0646\\u062a\",\"offline_reports\":\"\\u062a\\u0642\\u0627\\u0631\\u064a\\u0631 \\u062f\\u0648\\u0646 \\u0627\\u062a\\u0635\\u0627\\u0644\",\"export\":\"\\u062a\\u0635\\u062f\\u064a\\u0631\",\"free_bies\":\"\\u0645\\u062c\\u0627\\u0646\\u0627 \\u0628\\u064a\\u0633\",\"menus\":\"\\u0627\\u0644\\u0642\\u0648\\u0627\\u0626\\u0645\",\"settings\":\"\\u0625\\u0639\\u062f\\u0627\\u062f\\u0627\\u062a\",\"all users\":\"\\u062c\\u0645\\u064a\\u0639 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"users_dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u062a\\u062d\\u0643\\u0645 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\\u064a\\u0646\",\"role\":\"\\u0648\\u0638\\u064a\\u0641\\u0629\",\"user_statistics\":\"\\u0625\\u062d\\u0635\\u0627\\u0626\\u064a\\u0627\\u062a \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645\",\"view_all\":\"\\u0639\\u0631\\u0636 \\u0627\\u0644\\u0643\\u0644\",\"total_sales\":\"\\u0625\\u062c\\u0645\\u0627\\u0644\\u064a \\u0627\\u0644\\u0645\\u0628\\u064a\\u0639\\u0627\\u062a\",\"total_revenue\":\"\\u0625\\u062c\\u0645\\u0627\\u0644\\u064a \\u0627\\u0644\\u0625\\u064a\\u0631\\u0627\\u062f\\u0627\\u062a\",\"products_dashboard\":\"\\u0644\\u0648\\u062d\\u0629 \\u062a\\u062d\\u0643\\u0645 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\\u0627\\u062a\",\"product_approve_status\":\"\\u062d\\u0627\\u0644\\u0629 \\u0627\\u0644\\u0645\\u0648\\u0627\\u0641\\u0642\\u0629 \\u0639\\u0644\\u0649 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c\",\"approved\":\"\\u0648\\u0627\\u0641\\u0642\",\"approve\":\"\\u064a\\u0648\\u0627\\u0641\\u0642\",\"categories_dashboard\":\"\\u0627\\u0644\\u0641\\u0626\\u0627\\u062a \\u0644\\u0648\\u062d\\u0629 \\u0627\\u0644\\u062a\\u062d\\u0643\\u0645\",\"categories_list\":\"\\u0642\\u0627\\u0626\\u0645\\u0629 \\u0627\\u0644\\u0641\\u0626\\u0627\\u062a\",\"category_name\":\"\\u0627\\u0633\\u0645 \\u0627\\u0644\\u062a\\u0635\\u0646\\u064a\\u0641\",\"description\":\"\\u0648\\u0635\\u0641\",\"enter purpose of the category\":\"\\u0623\\u062f\\u062e\\u0644 \\u0627\\u0644\\u063a\\u0631\\u0636 \\u0645\\u0646 \\u0627\\u0644\\u0641\\u0626\\u0629\",\"meta tag title\":\"\\u0645\\u064a\\u062a\\u0627 \\u062a\\u0627\\u062c \\u062a\\u064a\\u062a\\u0644\",\"meta keywords\":\"\\u0643\\u0644\\u0645\\u0627\\u062a \\u062f\\u0644\\u0627\\u0644\\u064a\\u0629\",\"meta description\":\"\\u0645\\u064a\\u062a\\u0627 \\u0627\\u0644\\u0648\\u0635\\u0641\",\"select parent\":\"\\u062d\\u062f\\u062f \\u0627\\u0644\\u0648\\u0627\\u0644\\u062f\",\"icon\":\"\\u0623\\u064a\\u0642\\u0648\\u0646\\u0629\",\"active\":\"\\u0646\\u0634\\u064a\\u0637\",\"inactive\":\"\\u063a\\u064a\\u0631 \\u0646\\u0634\\u0637\",\"sub-cats\":\"\\u0627\\u0644\\u0642\\u0637\\u0637 \\u0627\\u0644\\u0641\\u0631\\u0639\\u064a\\u0629\"}', '2017-04-15 10:02:21', '2017-05-22 10:36:27');
INSERT INTO `languages` (`id`, `language`, `slug`, `code`, `is_rtl`, `is_default`, `is_default_admin`, `phrases`, `created_at`, `updated_at`) VALUES
(21, 'Chinese', 'chinese', 'ZH', 0, 0, 0, '{\"dashboard\":\"\\u4eea\\u8868\\u677f\",\"my_dashboard\":\"\\u6211\\u7684\\u4eea\\u8868\\u677f\",\"purchase history\":\"\\u8d2d\\u4e70\\u5386\\u53f2\",\"products\":\"\\u4ea7\\u54c1\",\"settings\":\"\\u8bbe\\u7f6e\",\"logout\":\"\\u767b\\u51fa\",\"profile\":\"\\u7b80\\u4ecb\",\"invalid_setting\":\"\\u8bbe\\u7f6e\\u65e0\\u6548\",\"edit account information\":\"\\u7f16\\u8f91\\u5e10\\u6237\\u4fe1\\u606f\",\"first name\":\"\\u540d\\u5b57\",\"this_field_is_required\":\"\\u8fd9\\u662f\\u5fc5\\u586b\\u680f\",\"last name\":\"\\u59d3\",\"facebook\":\"Facebook\",\"twitter\":\"\\u63a8\\u7279\",\"pinterest\":\"Pinterest\",\"dribbble\":\"\\u8fd0\\u7403\",\"about_me\":\"\\u5173\\u4e8e\\u6211\",\"about_me_few_words\":\"\\u5173\\u4e8e\\u6211\\u51e0\\u53e5\\u8bdd\",\"profile image\":\"\\u6863\\u6848\\u56fe\\u7247\",\"email address\":\"\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\",\"password\":\"\\u5bc6\\u7801\",\"re-enter password\":\"\\u91cd\\u65b0\\u8f93\\u5165\\u5bc6\\u7801\",\"edit billing address\":\"\\u7f16\\u8f91\\u5e10\\u5355\\u5730\\u5740\",\"address line1\":\"\\u5730\\u5740\\u680f1\",\"address line2\":\"\\u5730\\u5740Line2\",\"city\":\"\\u5e02\",\"zip code\":\"\\u90ae\\u653f\\u7f16\\u7801\",\"state\\/province\":\"\\u5dde\\/\\u7701\",\"country\":\"\\u56fd\\u5bb6\",\"click here to select\":\"\\u70b9\\u51fb\\u8fd9\\u91cc\\u9009\\u62e9\",\"file_type_not_allowed\":\"\\u6587\\u4ef6\\u7c7b\\u578b\\u4e0d\\u5141\\u8bb8\",\"name\":\"\\u540d\\u79f0\",\"phone_number\":\"\\u7535\\u8bdd\\u53f7\\u7801\",\"email\":\"\\u7535\\u5b50\\u90ae\\u4ef6\",\"message\":\"\\u4fe1\\u606f\",\"please_enter_your_message\":\"\\u8bf7\\u8f93\\u5165\\u60a8\\u7684\\u4fe1\\u606f\",\"pages\":\"\\u9875\\u9762\",\"my dashboard\":\"\\u6211\\u7684\\u4eea\\u8868\\u677f\",\"most popular\":\"\\u6700\\u53d7\\u6b22\\u8fce\",\"featured\":\"\\u7cbe\\u9009\",\"latest\":\"\\u6700\\u65b0\",\"freebies\":\"\\u8d60\\u54c1\",\"categories\":\"\\u7c7b\\u522b\",\"buy now\":\"\\u7acb\\u5373\\u8d2d\\u4e70\",\"details\":\"\\u7ec6\\u8282\",\"send\":\"\\u53d1\\u9001\",\"login\":\"\\u767b\\u5f55\",\"home_page_banner_heading\":\"\\u9996\\u9875\\u6a2a\\u5e45\\u6807\\u9898\",\"home_page_banner_sub_heading\":\"\\u9996\\u9875\\u6a2a\\u5e45\\u5c0f\\u6807\\u9898\",\"search by product\":\"\\u6309\\u4ea7\\u54c1\\u641c\\u7d22\",\"search\":\"\\u641c\\u7d22\",\"get \":\"\\u5f97\\u5230\",\" for just \":\"\\u5bf9\\u4e8eJust\",\"this offer expires on\":\"\\u6b64\\u4f18\\u60e0\\u5df2\\u8fc7\\u671f\",\"days\":\"\\u5929\",\"hours\":\"\\u5c0f\\u65f6\",\"mins\":\"\\u5206\\u949f\",\"sec\":\"\\u4e8c\\u6bb5\",\"view details\":\"\\u67e5\\u770b\\u8be6\\u60c5\",\"buy \":\"\\u8d2d\\u4e70\",\"popular\":\"\\u6d41\\u884c\",\"see all products\":\"\\u67e5\\u770b\\u6240\\u6709\\u4ea7\\u54c1\",\"please enter email address\":\"\\u8bf7\\u8f93\\u5165\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\",\"please enter valid email address\":\"\\u8bf7\\u8f93\\u5165\\u6709\\u6548\\u7684\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\",\"coupons\":\"\\u4f18\\u60e0\\u5238\",\"view_details\":\"\\u67e5\\u770b\\u8be6\\u60c5\",\"purchases\":\"\\u8d2d\\u4e70\",\"amount\":\"\\u91cf\",\"no purchases found\":\"\\u627e\\u4e0d\\u5230\\u91c7\\u8d2d\",\"click %s to purchase\":\"\\u70b9\\u51fb\\uff05s\\u8d2d\\u4e70\",\"here\":\"\\u8fd9\\u91cc\",\"image\":\"\\u56fe\\u7247\",\"no products found\":\"\\u627e\\u4e0d\\u5230\\u4ea7\\u54c1\",\"home\":\"\\u5bb6\",\"add to cart\":\"\\u6dfb\\u52a0\\u5230\\u8d2d\\u7269\\u8f66\",\"share:\":\"\\u5206\\u4eab\\uff1a\",\"duration\":\"\\u6301\\u7eed\\u65f6\\u95f4\",\"buy\":\"\\u8d2d\\u4e70\",\"about author\":\"\\u5173\\u4e8e\\u4f5c\\u8005\",\"products : \":\"\\u4ea7\\u54c1\\uff1a\",\"product info\":\"\\u4ea7\\u54c1\\u4fe1\\u606f\",\"downloads\":\"\\u4e0b\\u8f7d\",\"related products\":\"\\u76f8\\u5173\\u4ea7\\u54c1\",\"please select\":\"\\u8bf7\\u9009\\u62e9\",\"cart_details\":\"\\u8d2d\\u7269\\u8f66\\u8be6\\u60c5\",\"cart\":\"\\u5927\\u8f66\",\"your cart\":\"\\u4f60\\u7684\\u8d2d\\u7269\\u8f66\",\"product name\":\"\\u4ea7\\u54c1\\u540d\\u79f0\",\"product price\":\"\\u4ea7\\u54c1\\u4ef7\\u683c\",\"options\":\"\\u9009\\u9879\",\"continue shopping\":\"\\u7ee7\\u7eed\\u8d2d\\u7269\",\"total cart\":\"TOTAL CART\",\"products price :\":\"\\u4ea7\\u54c1\\u4ef7\\u683c\\uff1a\",\"tax :\":\"\\u7a0e\\uff1a\",\"support fee :\":\"\\u652f\\u6301\\u8d39\\u7528\\uff1a\",\"total price :\":\"\\u603b\\u4ef7\\uff1a\",\"check out\":\"\\u67e5\\u770b\",\"your cart is empty\":\"\\u60a8\\u7684\\u8d2d\\u7269\\u8f66\\u662f\\u7a7a\\u7684\",\"view_more\":\"\\u67e5\\u770b\\u66f4\\u591a\",\"login_here\":\"\\u5728\\u6b64\\u767b\\u5f55\",\"go to my account\":\"\\u8f6c\\u5230\\u6211\\u7684\\u5e10\\u6237\",\"log in\":\"\\u767b\\u5f55\",\"dont have account? create now\":\"\\u6ca1\\u6709\\u5e10\\u53f7\\uff1f\\u7acb\\u5373\\u521b\\u5efa\",\"forgot password?\":\"\\u5fd8\\u8bb0\\u5bc6\\u7801\\uff1f\",\"please enter password\":\"\\u8bf7\\u8f93\\u5165\\u5bc6\\u7801\",\"hope you enjoyed the shopping with us. visit again.\":\"\\u5e0c\\u671b\\u4f60\\u559c\\u6b22\\u4e0e\\u6211\\u4eec\\u4e00\\u8d77\\u8d2d\\u7269\\u3002\\u518d\\u6b21\\u8bbf\\u95ee\",\"success\":\"\\u6210\\u529f\",\"\\u5e0c\\u671b\\u4f60\\u559c\\u6b22\\u4e0e\\u6211\\u4eec\\u4e00\\u8d77\\u8d2d\\u7269\\u3002\\u518d\\u6b21\\u8bbf\\u95ee\":\"\\u5e0c\\u671b\\u4f60\\u559c\\u6b22\\u4e0e\\u6211\\u4eec\\u4e00\\u8d77\\u8d2d\\u7269\\u3002\\u518d\\u6b21\\u8bbf\\u95ee\",\"go_to_my_account\":\"\\u8f6c\\u5230\\u6211\\u7684\\u5e10\\u6237\",\"log_in\":\"\\u767b\\u5f55\",\"dont_have_account?_create_now\":\"\\u6ca1\\u6709\\u5e10\\u53f7\\uff1f\\u7acb\\u5373\\u521b\\u5efa\",\"forgot_password?\":\"\\u5fd8\\u8bb0\\u5bc6\\u7801\\uff1f\",\"please_enter_email_address\":\"\\u8bf7\\u8f93\\u5165\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\",\"please_enter_valid_email_address\":\"\\u8bf7\\u8f93\\u5165\\u6709\\u6548\\u7684\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\",\"please_enter_password\":\"\\u8bf7\\u8f93\\u5165\\u5bc6\\u7801\",\"contact_us\":\"\\u8054\\u7cfb\\u6211\\u4eec\",\"jack\":\"\\u63d2\\u53e3\",\"jack@jarvis.com\":\"Jack@jarvis.com\",\"about us\":\"\\u5173\\u4e8e\\u6211\\u4eec\",\"digisamaritan\":\"Digisamaritan\",\"useful links\":\"\\u6709\\u7528\\u7684\\u94fe\\u63a5\",\"privacy and policy\":\"\\u9690\\u79c1\\u548c\\u653f\\u7b56\",\"terms & conditions\":\"\\u6761\\u6b3e\\u548c\\u6761\\u4ef6\",\"about us footer\":\"\\u5173\\u4e8e\\u6211\\u4eec\",\"contact us\":\"\\u8054\\u7cfb\\u6211\\u4eec\",\"dummy text\":\"\\u865a\\u62df\\u6587\\u672c\",\"text one\":\"\\u6587\\u5b57\\u4e00\",\"text two\":\"\\u6587\\u672c\\u4e8c\",\"text three\":\"\\u6587\\u672c\\u4e09\",\"our services\":\"\\u6211\\u4eec\\u7684\\u670d\\u52a1\",\"sales\":\"\\u9500\\u552e\",\"uploads\":\"\\u4e0a\\u4f20\",\"services one\":\"\\u670d\\u52a1\\u4e00\",\"services two\":\"\\u670d\\u52a1\\u4e8c\",\"contact\":\"\\u8054\\u7cfb\",\"register\":\"\\u5bc4\\u5b58\\u5668\",\"greate_join_with_us\":\"Greate\\u52a0\\u5165\\u6211\\u4eec\",\"click\":\"\\u70b9\\u51fb\",\"to_register_as_vendor\":\"\\u6ce8\\u518c\\u4e3a\\u4f9b\\u5e94\\u5546\",\"email_address\":\"\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\",\"first_name\":\"\\u540d\\u5b57\",\"last_name\":\"\\u59d3\",\"re-enter_password\":\"\\u91cd\\u65b0\\u8f93\\u5165\\u5bc6\\u7801\",\"by_creating_an_account_you_agree_to_our \":\"\\u901a\\u8fc7\\u521b\\u5efa\\u4e00\\u4e2a\\u60a8\\u540c\\u610f\\u6211\\u4eec\\u7684\\u5e10\\u6237\",\"terms_and_conditions\":\"\\u6761\\u6b3e\\u548c\\u6761\\u4ef6\",\"and our\":\"\\u548c\\u6211\\u4eec\\u7684\",\"privacy_policy\":\"\\u9690\\u79c1\\u653f\\u7b56\",\"already_having_account?\":\"\\u5df2\\u7ecf\\u6709\\u8d26\\u6237\\uff1f\",\"please_enter_first_name\":\"\\u8bf7\\u8f93\\u5165\\u540d\\u5b57\",\"please_accept_the_terms_and_conditions\":\"\\u8bf7\\u63a5\\u53d7\\u6761\\u6b3e\\u548c\\u6761\\u4ef6\",\"password should be at least 6 characters\":\"\\u5bc6\\u7801\\u5e94\\u81f3\\u5c116\\u4e2a\\u5b57\\u7b26\",\"please enter password again to confirm\":\"\\u8bf7\\u518d\\u6b21\\u8f93\\u5165\\u5bc6\\u7801\\u4ee5\\u786e\\u8ba4\",\"password and re-enter password not same\":\"\\u5bc6\\u7801\\u5e76\\u91cd\\u65b0\\u8f93\\u5165\\u5bc6\\u7801\\u4e0d\\u4e00\\u6837\",\"purchase_history\":\"\\u8d2d\\u4e70\\u5386\\u53f2\",\"upload_purchases\":\"\\u4e0a\\u4f20\\u91c7\\u8d2d\",\"user_name\":\"\\u7528\\u6237\\u540d\",\"paid_amount\":\"\\u5df2\\u4ed8\\u91d1\\u989d\",\"payment_gateway\":\"\\u4ed8\\u6b3e\\u7f51\\u5173\",\"updated_at\":\"\\u66f4\\u65b0\\u4e8e\",\"payment_status\":\"\\u652f\\u4ed8\\u72b6\\u6001\",\"product_details\":\"\\u4ea7\\u54c1\\u8be6\\u60c5\",\"ok\":\"\\u597d\",\"admin_commission : \":\"\\u7ba1\\u7406\\u59d4\\u5458\\u4f1a\",\"title\":\"\\u6807\\u9898\",\"code\":\"\\u7801\",\"discount_type\":\"\\u6298\\u6263\\u7c7b\\u578b\",\"value\":\"\\u503c\",\"minimum_amount\":\"\\u6700\\u4f4e\\u91d1\\u989d\",\"start_date\":\"\\u5f00\\u59cb\\u65e5\\u671f\",\"end_date\":\"\\u7ed3\\u675f\\u65e5\\u671f\",\"status\":\"\\u72b6\\u6001\",\"are_you_sure\":\"\\u4f60\\u786e\\u5b9a\",\"you_will_not_be_able_to_recover_this_record\":\"\\u60a8\\u5c06\\u65e0\\u6cd5\\u6062\\u590d\\u6b64\\u8bb0\\u5f55\",\"yes\":\"\\u662f\",\"delete_it\":\"\\u5220\\u9664\\u5b83\",\"no\":\"\\u6ca1\\u6709\",\"cancel_please\":\"\\u53d6\\u6d88\\u8bf7\",\"deleted\":\"\\u5220\\u9664\",\"sorry\":\"\\u62b1\\u6b49\",\"cannot_delete_this_record_as\":\"\\u65e0\\u6cd5\\u5c06\\u6b64\\u8bb0\\u5f55\\u5220\\u9664\",\"your_record_has_been_deleted\":\"\\u60a8\\u7684\\u8bb0\\u5f55\\u5df2\\u88ab\\u5220\\u9664\",\"cancelled\":\"\\u53d6\\u6d88\",\"your_record_is_safe\":\"\\u4f60\\u7684\\u8bb0\\u5f55\\u662f\\u5b89\\u5168\\u7684\",\"total_products\":\"\\u603b\\u4ea7\\u54c1\",\"product_name\":\"\\u4ea7\\u54c1\\u540d\\u79f0\",\"paid_amont\":\"\\u4ed8\\u6b3eAmont\",\"download\":\"\\u4e0b\\u8f7d\",\"product_owner\":\"\\u4ea7\\u54c1\\u62e5\\u6709\\u8005\",\"coupon_applied\":\"\\u4f18\\u60e0\\u5238\\u5e94\\u7528\",\"coupon_name\":\"\\u4f18\\u60e0\\u5238\\u540d\\u79f0\",\"discount\":\"\\u6298\\u6263\",\"licence_applied\":\"\\u5e94\\u7528\\u8bb8\\u53ef\\u8bc1\",\"licence_name\":\"\\u8bb8\\u53ef\\u8bc1\\u540d\\u79f0\",\"licence_fee\":\"\\u8bb8\\u53ef\\u8d39\",\"licence\":\"\\u6267\\u7167\",\"regular\":\"\\u5b9a\\u671f\",\"product_cost\":\"\\u4ea7\\u54c1\\u6210\\u672c\",\"add\":\"\\u52a0\",\"import\":\"\\u8fdb\\u53e3\",\"price\":\"\\u4ef7\\u94b1\",\"approve_status\":\"\\u6279\\u51c6\\u72b6\\u6001\",\"action\":\"\\u884c\\u52a8\",\"are_you_sure_to_make_approve_this_product\":\"\\u4f60\\u786e\\u5b9a\\u6279\\u51c6\\u8fd9\\u4e2a\\u4ea7\\u54c1\",\"we have not found email address entered\":\"\\u6211\\u4eec\\u5c1a\\u672a\\u627e\\u5230\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\",\"please check email address or password either one is wrong\":\"\\u8bf7\\u68c0\\u67e5\\u7535\\u5b50\\u90ae\\u4ef6\\u5730\\u5740\\u6216\\u5bc6\\u7801\\u662f\\u5426\\u662f\\u9519\\u8bef\",\"ooops...!\":\"\\u5662...\\uff01\",\"add products\":\"\\u6dfb\\u52a0\\u4ea7\\u54c1\",\"invalid_input\":\"\\u8f93\\u5165\\u65e0\\u6548\",\"the_text_is_too_short\":\"\\u6587\\u5b57\\u592a\\u77ed\",\"the_text_is_too_long\":\"\\u6587\\u5b57\\u592a\\u957f\\u4e86\",\"format\":\"\\u683c\\u5f0f\",\"active\":\"\\u6d3b\\u6027\",\"inactive\":\"\\u5f85\\u7528\",\"is_featured\":\"\\u7279\\u8272\",\"please select categorie(s)\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"licences\":\"\\u8bb8\\u53ef\\u8bc1\",\"please select licences(s)\":\"\\u8bf7\\u9009\\u62e9\\u8bb8\\u53ef\\u8bc1\",\"price settings\":\"\\u4ef7\\u683c\\u8bbe\\u7f6e\",\"default\":\"\\u9ed8\\u8ba4\",\"variable\":\"\\u53d8\\u91cf\",\"price_type\":\"\\u4ef7\\u683c\\u7c7b\\u578b\",\"eg: 2\":\"\\u4f8b\\u5982\\uff1a2\",\"price_display_type\":\"\\u4ef7\\u683c\\u663e\\u793a\\u7c7b\\u578b\",\"checkbox\":\"\\u590d\\u9009\\u6846\",\"radio\":\"\\u65e0\\u7ebf\\u7535\",\"option name\":\"\\u9009\\u9879\\u540d\\u79f0\",\"id\":\"ID\",\"remove price option %s\":\"\\u5220\\u9664\\u4ef7\\u683c\\u9009\\u9879\\uff05s\",\"add new price\":\"\\u6dfb\\u52a0\\u65b0\\u4ef7\\u683c\",\"download files\":\"\\u4e0b\\u8f7d\\u6587\\u4ef6\",\"file name\":\"\\u6587\\u4ef6\\u540d\",\"type\":\"\\u7c7b\\u578b\",\"file url\":\"\\u6587\\u4ef6\\u7f51\\u5740\",\"price assignment\":\"\\u4ef7\\u683c\\u5206\\u914d\",\"please select type\":\"\\u8bf7\\u9009\\u62e9\\u7c7b\\u578b\",\"file\":\"\\u6587\\u4ef6\",\"url\":\"\\u7f51\\u5740\",\"add new file\":\"\\u6dfb\\u52a0\\u65b0\\u6587\\u4ef6\",\"download_limits\":\"\\u4e0b\\u8f7d\\u9650\\u5236\",\"leave blank for global setting or 0 for unlimited\":\"\\u7559\\u7a7a\\u4e3a\\u5168\\u5c40\\u8bbe\\u7f6e\\u62160\\u4e3a\\u65e0\\u9650\",\"self_upload\":\"\\u81ea\\u6211\\u4e0a\\u4f20\",\"thrid_party\":\"thrd\\u515a\",\"product_belongsto\":\"\\u4ea7\\u54c1\\u5c5e\\u6027\",\"demo link\":\"\\u6f14\\u793a\\u94fe\\u63a5\",\"demo link eg: http:\\/\\/site.com\":\"\\u4f8b\\u5982\\uff1ahttp\\uff1a\\/\\/site.com\",\"preview image\":\"\\u9884\\u89c8\\u56fe\\u50cf\",\"licence_of_use\":\"\\u4f7f\\u7528\\u8bb8\\u53ef\",\"licence_of_use for the product\":\"\\u4ea7\\u54c1\\u4f7f\\u7528\\u8bb8\\u53ef\\u8bc1\",\"technical_info\":\"\\u6280\\u672f\\u8d44\\u6599\",\"technical_info for the product\":\"\\u4ea7\\u54c1\\u6280\\u672f\\u4fe1\\u606f\",\"description\":\"\\u63cf\\u8ff0\",\"description for the product\":\"\\u4ea7\\u54c1\\u63cf\\u8ff0\",\"download_notes\":\"\\u4e0b\\u8f7d\\u5907\\u6ce8\",\"download notes for the product\":\"\\u4e0b\\u8f7d\\u4ea7\\u54c1\\u8bf4\\u660e\",\"title meta tag\":\"\\u6807\\u9898\\u5143\\u6807\\u7b7e\",\"product seo title\":\"\\u4ea7\\u54c1Seo\\u6807\\u9898\",\"description meta tag\":\"\\u63cf\\u8ff0\\u5143\\u6807\\u7b7e\",\"kewords meta tag\":\"Kewords\\u5143\\u6807\\u7b7e\",\"kewords meta tags separated with comma(,)\":\"Kewords Meta\\u6807\\u7b7e\\u4e0e\\u9017\\u53f7\\u5206\\u5f00\\uff08\\uff0c\\uff09\",\"product_format\":\"\\u4ea7\\u54c1\\u683c\\u5f0f\",\"please_select_categorie(s)\":\"\\u8bf7\\u9009\\u62e9\\u5206\\u7c7b\",\"please_select_licences(s)\":\"\\u8bf7\\u9009\\u62e9\\u8bb8\\u53ef\\u8bc1\",\"price_settings\":\"\\u4ef7\\u683c\\u8bbe\\u7f6e\",\"option_name\":\"\\u9009\\u9879\\u540d\\u79f0\",\"add_new_price\":\"\\u6dfb\\u52a0\\u65b0\\u4ef7\\u683c\",\"file_name\":\"\\u6587\\u4ef6\\u540d\",\"price_assignment\":\"\\u4ef7\\u683c\\u5206\\u914d\",\"demo_link\":\"\\u6f14\\u793a\\u94fe\\u63a5\",\"demo_link eg: http:\\/\\/site.com\":\"\\u4f8b\\u5982\\uff1ahttp\\uff1a\\/\\/site.com\",\"preview_image\":\"\\u9884\\u89c8\\u56fe\\u50cf\",\"licence_of_use_for_the_product\":\"\\u4ea7\\u54c1\\u4f7f\\u7528\\u8bb8\\u53ef\\u8bc1\",\"technical_info_for_the_product\":\"\\u4ea7\\u54c1\\u6280\\u672f\\u4fe1\\u606f\",\"description_for_the_product\":\"\\u4ea7\\u54c1\\u63cf\\u8ff0\",\"download_notes_for_the_product\":\"\\u4e0b\\u8f7d\\u4ea7\\u54c1\\u8bf4\\u660e\",\"title_meta_tag\":\"\\u6807\\u9898\\u5143\\u6807\\u7b7e\",\"product_seo_title\":\"\\u4ea7\\u54c1Seo\\u6807\\u9898\",\"description_meta_tag\":\"\\u63cf\\u8ff0\\u5143\\u6807\\u7b7e\",\"kewords_meta_tag\":\"Kewords\\u5143\\u6807\\u7b7e\",\"kewords_meta_tags_separated_with_comma(,)\":\"Kewords Meta\\u6807\\u7b7e\\u4e0e\\u9017\\u53f7\\u5206\\u5f00\\uff08\\uff0c\\uff09\",\"create\":\"\\u521b\\u5efa\",\"seo_settings\":\"Seo\\u8bbe\\u7f6e\",\"please_select_type\":\"\\u8bf7\\u9009\\u62e9\\u7c7b\\u578b\",\"please_select\":\"\\u8bf7\\u9009\\u62e9\",\"buy_now\":\"\\u7acb\\u5373\\u8d2d\\u4e70\",\"_empty_\":\"\",\"1\":\"1\",\"translation to \":\"\\u7ffb\\u8bd1\\u5230\",\"static pages\\/fo\":\"\\u9759\\u6001\\u9875\\/ fo\",\"video upload plugin\":\"\\u89c6\\u9891\\u4e0a\\u4f20\\u63d2\\u4ef6\",\"p2\":\"P2\",\"php scripts\":\"Php\\u811a\\u672c\",\"wordpress\":\"WordPress\\u7684\",\"ecommerce\":\"\\u7535\\u5b50\\u5546\\u52a1\",\" javascript\":\"\\u4f7f\\u7528Javascript\",\"css\":\"CSS\",\"mobile\":\"\\u79fb\\u52a8\",\"html5\":\"HTML5\",\"skins\":\"\\u76ae\\u80a4\",\"plugins\":\"\\u63d2\\u4ef6\",\".net\":\"\\u3002\\u51c0\",\"marketing\":\"\\u8425\\u9500\",\"cms themes\":\"Cms\\u4e3b\\u9898\",\"muse templates\":\"\\u7f2a\\u65af\\u6a21\\u677f\",\"ui design\":\"Ui\\u8bbe\\u8ba1\",\"blogging\":\"\\u5199\\u535a\\u5ba2\",\"facebook templates\":\"Facebook\\u6a21\\u677f\",\"after effects project file\":\"After Effects\\u9879\\u76ee\\u6587\\u4ef6\",\"apple motion templates\":\"\\u82f9\\u679c\\u8fd0\\u52a8\\u6a21\\u677f\",\"motion graphics\":\"\\u8fd0\\u52a8\\u56fe\\u5f62\",\"stock footage\":\"\\u5f71\\u89c6\\u7d20\\u6750\",\"cinema 4d templates\":\"\\u7535\\u5f714d\\u6a21\\u677f\",\"animated svgs\":\"\\u52a8\\u753bSvgs\",\"video displays\":\"\\u89c6\\u9891\\u663e\\u793a\",\"form generator \":\"\\u5f62\\u5f0f\\u53d1\\u751f\\u5668\",\"fiverr script stats\":\"Fiverr\\u811a\\u672c\\u7edf\\u8ba1\",\"rating system\":\"\\u8bc4\\u7ea7\\u7cfb\\u7edf\",\"live demo\":\"\\u73b0\\u573a\\u6f14\\u793a\",\"license of use\":\"\\u4f7f\\u7528\\u8bb8\\u53ef\",\"technical info\":\"\\u6280\\u672f\\u4fe1\\u606f\",\"add_to_cart\":\"\\u6dfb\\u52a0\\u5230\\u8d2d\\u7269\\u8f66\",\"about_author\":\"\\u5173\\u4e8e\\u4f5c\\u8005\",\"product_info\":\"\\u4ea7\\u54c1\\u4fe1\\u606f\",\"related_products\":\"\\u76f8\\u5173\\u4ea7\\u54c1\",\"search_by_product\":\"\\u6309\\u4ea7\\u54c1\\u641c\\u7d22\",\"select\":\"\\u9009\\u62e9\",\"add-ons\":\"\\u9644\\u52a0\\u7ec4\\u4ef6\",\"calendars\":\"\\u65e5\\u5386\",\"countdowns\":\"\\u5012\\u8ba1\\u65f6\",\"forms\":\"\\u5f62\\u5f0f\",\"vishnu-category\":\"\\u6bd7\\u6e7f\\u5974\\u7c7b\",\"advertising\":\"\\u5e7f\\u544a\",\"forums\":\"\\u8bba\\u575b\",\"galleries\":\"\\u753b\\u5eca\",\"media\":\"\\u5a92\\u4f53\",\"jigoshop\":\"Jigoshop\",\"magento extensions\":\"Magento\\u6269\\u5c55\",\"opencart\":\"Opencart\\u7684\",\"oscommerce\":\"\\u81ea\\u4ece\",\"prestashop\":\"\\u7684Prestashop\",\"images and media\":\"\\u56fe\\u50cf\\u548c\\u5a92\\u4f53\",\"loaders and uploaders\":\"\\u88c5\\u8f7d\\u673a\\u548c\\u4e0a\\u4f20\\u5668\",\"animations and effects\":\"\\u52a8\\u753b\\u548c\\u6548\\u679c\",\"buttons\":\"\\u7ebd\\u6263\",\"charts and graphs\":\"\\u56fe\\u8868\\u548c\\u56fe\\u8868\",\"layouts\":\"\\u5e03\\u5c40\",\"android\":\"Android\\u7684\",\"ios\":\"\\u4f9d\\u5965\\u65af\",\"native web\":\"\\u672c\\u5730Web\",\"titanium\":\"\\u949b\",\"3d\":\"3D\",\"canvas\":\"\\u5e06\\u5e03\",\"games\":\"\\u6e38\\u620f\",\"libraries\":\"\\u56fe\\u4e66\\u9986\",\"bootstrap\":\"\\u5f15\\u5bfc\",\"layers wp style kits\":\"\\u5c42Wp\\u98ce\\u683c\\u5957\\u4ef6\",\"miscellaneous\":\"\\u6742\",\"concrete5\":\"Concrete5\",\"drupal\":\"Drupal\\u7684\",\"expression engine\":\"\\u8868\\u8fbe\\u5f15\\u64ce\",\"joomla\":\"\\u7684Joomla\",\"content management\":\"\\u5185\\u5bb9\\u7ba1\\u7406\",\"email templates\":\"\\u7535\\u5b50\\u90ae\\u4ef6\\u6a21\\u677f\",\"instapage\":\"Instapage\",\"landing pages\":\"\\u7740\\u9646\\u9875\",\"pagewiz\":\"Pagewiz\",\"moodle\":\"Moodle\\u7684\",\"mura\":\"\\u6751\",\"webflow\":\"\\u4e00\\u4e2aWebflow\",\"weebly\":\"Weebly\",\"corporate\":\"\\u4f01\\u4e1a\",\"creative\":\"\\u521b\\u4f5c\\u7684\",\"landing\":\"\\u964d\\u843d\",\"psd templates\":\"Psd\\u6a21\\u677f\",\"popular psd templates\":\"\\u70ed\\u95e8Psd\\u6a21\\u677f\",\"sketch templates\":\"\\u7d20\\u63cf\\u6a21\\u677f\",\"popular sketch templates\":\"\\u70ed\\u95e8\\u7d20\\u63cf\\u6a21\\u677f\",\"portfolio\":\"\\u6295\\u8d44\\u7ec4\\u5408\",\"ghost themes\":\"\\u5e7d\\u7075\\u4e3b\\u9898\",\"blogger\":\"\\u535a\\u5ba2\",\"blog\":\"\\u535a\\u5ba2\",\"business\":\"\\u5546\\u4e1a\",\"magazine\":\"\\u6742\\u5fd7\",\"photography\":\"\\u6444\\u5f71\",\"broadcast packages\":\"\\u5e7f\\u64ad\\u5305\",\"element 3d\":\"\\u5143\\u7d203d\",\"elements\":\"\\u5206\\u5b50\",\"infographics\":\"\\u4fe1\\u606f\\u56fe\\u8868\",\"logo stings\":\"\\u6807\\u5fd7\\u8707\",\"openers\":\"\\u5f00\\u74f6\\u5668\",\"titles\":\"\\u6807\\u9898\",\"backgrounds\":\"\\u80cc\\u666f\",\"bugs\":\"\\u9519\\u8bef\",\"interface effects\":\"\\u754c\\u9762\\u6548\\u5e94\",\"lower thirds\":\"\\u4e0b\\u4e09\\u5206\\u4e4b\\u4e00\",\"buildings\":\"\\u623f\\u5c4b\",\"construction\":\"\\u65bd\\u5de5\",\"education\":\"\\u6559\\u80b2\",\"food\":\"\\u9910\\u996e\",\"this_offer_expires_on\":\"\\u6b64\\u4f18\\u60e0\\u5df2\\u8fc7\\u671f\",\"more_offers\":\"\\u66f4\\u591a\\u4f18\\u60e0\",\"see_all_products\":\"\\u67e5\\u770b\\u6240\\u6709\\u4ea7\\u54c1\",\"all_offers\":\"\\u6240\\u6709\\u4f18\\u60e0\",\"this offer expires on:\":\"\\u6b64\\u4f18\\u60e0\\u5df2\\u8fc7\\u671f\\uff1a\",\"no_products_found\":\"\\u627e\\u4e0d\\u5230\\u4ea7\\u54c1\",\"product_price\":\"\\u4ea7\\u54c1\\u4ef7\\u683c\",\"continue_shopping\":\"\\u7ee7\\u7eed\\u8d2d\\u7269\",\"total_cart\":\"\\u603b\\u8d2d\\u7269\\u8f66\",\"products_price\":\"\\u4ea7\\u54c1\\u4ef7\\u683c\",\"tax\":\"\\u7a0e\",\"support_fee\":\"\\u652f\\u6301\\u8d39\",\"total_price\":\"\\u603b\\u4ef7\",\"check_out\":\"\\u67e5\\u770b\",\"your_cart_is_empty\":\"\\u60a8\\u7684\\u8d2d\\u7269\\u8f66\\u662f\\u7a7a\\u7684\",\"translation to any language\":\"\\u7ffb\\u8bd1\\u5230\\u4efb\\u4f55\\u8bed\\u8a00\",\"form generator with payment system\":\"\\u652f\\u4ed8\\u7cfb\\u7edf\\u5f62\\u5f0f\\u53d1\\u7535\\u673a\",\"checkout\":\"\\u67e5\\u770b\",\"select_payment_method\":\"\\u9009\\u62e9\\u4ed8\\u6b3e\\u65b9\\u5f0f\",\"billing_address\":\"\\u5e10\\u5355\\u5730\\u5740\",\"address_line1\":\"\\u5730\\u5740\\u680f1\",\"address_line2\":\"\\u5730\\u5740Line2\",\"zip_code\":\"\\u90ae\\u653f\\u7f16\\u7801\",\"state_\\/_province\":\"\\u5dde\\/\\u7701\",\"purchase\":\"\\u91c7\\u8d2d\",\"have_coupon_code?\":\"\\u6709\\u4f18\\u60e0\\u5238\\u4ee3\\u7801\\uff1f\",\"apply\":\"\\u5e94\\u7528\",\"please enter first name\":\"\\u8bf7\\u8f93\\u5165\\u540d\\u5b57\",\"info\":\"\\u4fe1\\u606f\",\"please select payment gateway\":\"\\u8bf7\\u9009\\u62e9\\u4ed8\\u6b3e\\u7f51\\u5173\",\"please enter coupon code\":\"\\u8bf7\\u8f93\\u5165\\u4f18\\u60e0\\u5238\\u4ee3\\u7801\",\"please_enter_coupon_code\":\"\\u8bf7\\u8f93\\u5165\\u4f18\\u60e0\\u5238\\u4ee3\\u7801\",\"enter_code_here\":\"\\u5728\\u6b64\\u5904\\u8f93\\u5165\\u4ee3\\u7801\",\"save_changes\":\"\\u4fdd\\u5b58\\u66f4\\u6539\",\"pending\":\"\\u6709\\u5f85\",\"approved\":\"\\u6279\\u51c6\",\"ooops..!\":\"\\u54ce\\u5440..\\uff01\",\"you have no permission to access\":\"\\u4f60\\u6ca1\\u6709\\u6743\\u9650\\u8bbf\\u95ee\",\"user_statistics\":\"\\u7528\\u6237\\u7edf\\u8ba1\",\"view_all\":\"\\u67e5\\u770b\\u5168\\u90e8\",\"offers\":\"\\u5546\\u60c5\",\"users\":\"\\u7528\\u6237\",\"payment_reports\":\"\\u4ed8\\u6b3e\\u62a5\\u544a\",\"total_sales\":\"\\u603b\\u9500\\u552e\\u989d\",\"total_revenue\":\"\\u603b\\u6536\\u5165\",\"toggle navigation\":\"\\u5207\\u6362\\u5bfc\\u822a\",\"sign out\":\"\\u767b\\u51fa\",\"online\":\"\\u7ebf\\u4e0a\",\"all\":\"\\u6240\\u6709\",\"owners\":\"\\u62e5\\u6709\\u8005\",\"admins\":\"\\u7ba1\\u7406\\u5458\",\"executives\":\"\\u9ad8\\u7ba1\",\"vendors\":\"\\u4f9b\\u5e94\\u5546\",\"customers\":\"\\u987e\\u5ba2\",\"list\":\"\\u540d\\u5355\",\"templates\":\"\\u6a21\\u677f\",\"online_reports\":\"\\u5728\\u7ebf\\u62a5\\u544a\",\"offline_reports\":\"\\u79bb\\u7ebf\\u62a5\\u544a\",\"export\":\"\\u51fa\\u53e3\",\"free_bies\":\"\\u514d\\u8d39\\u7684Bies\",\"menus\":\"\\u83dc\\u5355\",\"languages\":\"\\u8bed\\u8a00\",\"categories_dashboard\":\"\\u5206\\u7c7b\\u4eea\\u8868\\u677f\",\"language\":\"\\u8bed\\u8a00\",\"default_language\":\"\\u9ed8\\u8ba4\\u8bed\\u8a00\",\"enable\":\"\\u542f\\u7528\",\"set_default\":\"\\u9ed8\\u8ba4\\u8bbe\\u7f6e\",\"disable\":\"\\u7981\\u7528\",\"record_updated_successfully\":\"\\u8bb0\\u5f55\\u66f4\\u65b0\\u6210\\u529f\",\"subject\":\"\\u5b66\\u79d1\",\"from email\":\"\\u4ece\\u7535\\u5b50\\u90ae\\u4ef6\",\"from name\":\"\\u4ece\\u540d\\u5b57\",\"add templates\":\"\\u6dfb\\u52a0\\u6a21\\u677f\",\"eg: wordpress templates\":\"\\u4f8b\\u5982\\uff1aWordpress\\u6a21\\u677f\",\"header\":\"\\u5934\",\"footer\":\"\\u9875\\u811a\",\"content\":\"\\u5185\\u5bb9\",\"from_email\":\"\\u4ece\\u7535\\u5b50\\u90ae\\u4ef6\",\"eg: admin@admin.com\":\"\\u4f8b\\u5982Admin@admin.com\",\"from_name\":\"\\u4ece\\u540d\\u5b57\",\"sms\":\"\\u77ed\\u4fe1\",\"content for the template\":\"\\u6a21\\u677f\\u5185\\u5bb9\",\"sub-cats\":\"\\u5b50\\u732b\",\"import categories\":\"\\u8fdb\\u53e3\\u7c7b\\u522b\",\"\\u7c7b\\u522b\":\"\\u7c7b\\u522b\",\"download template here\":\"\\u4e0b\\u8f7d\\u6a21\\u677f\",\"excel\":\"\\u9ad8\\u5f3a\",\"eg: introduction offer\":\"\\u4f8b\\u5982\\uff1a\\u7b80\\u4ecb\\u4f18\\u60e0\",\"categories_list\":\"\\u5206\\u7c7b\\u5217\\u8868\",\"category_name\":\"\\u5206\\u7c7b\\u540d\\u79f0\",\"enter purpose of the category\":\"\\u8f93\\u5165\\u7c7b\\u522b\\u7684\\u76ee\\u7684\",\"meta tag title\":\"\\u5143\\u6807\\u7b7e\\u6807\\u9898\",\"meta keywords\":\"\\u5143\\u5173\\u952e\\u8bcd\",\"meta description\":\"\\u5143\\u63cf\\u8ff0\",\"select parent\":\"\\u9009\\u62e9\\u7236\\u6bcd\",\"icon\":\"\\u56fe\\u6807\",\"add_category\":\"\\u6dfb\\u52a0\\u7c7b\\u522b\",\"products_dashboard\":\"\\u4ea7\\u54c1\\u4eea\\u8868\\u677f\",\"product_approve_status\":\"\\u4ea7\\u54c1\\u6279\\u51c6\\u72b6\\u6001\",\"approve\":\"\\u6279\\u51c6\",\"products_list\":\"\\u4ea7\\u54c1\\u5217\\u8868\",\"edit_product\":\"\\u7f16\\u8f91\\u4ea7\\u54c1\",\"are_you_sure_to_make_clear_file\":\"\\u4f60\\u786e\\u5b9a\\u8981\\u6e05\\u9664\\u6587\\u4ef6\\u5417\\uff1f\",\"import products\":\"\\u8fdb\\u53e3\\u4ea7\\u54c1\",\"\\u4ea7\\u54c1\":\"\\u4ea7\\u54c1\",\"add coupon\":\"\\u6dfb\\u52a0\\u4f18\\u60e0\\u5238\",\"coupon title\":\"\\u4f18\\u60e0\\u5238\\u540d\\u79f0\",\"eg: 326f6\":\"\\u4f8b\\u5982\\uff1a326f6\",\"percent\":\"\\u767e\\u5206\",\"eg: 23\":\"\\u4f8b\\u5982\\uff1a23\",\"max_discount_amount\":\"\\u6700\\u9ad8\\u6298\\u6263\\u91d1\\u989d\",\"eg: 50\":\"\\u4f8b\\u5982\\uff1a50\",\"minimum_amount. leave 0 for no minimum amount limitation.\":\"\\u6700\\u4f4e\\u91d1\\u989d\\u3002\\u79bb\\u5f000\\u4e3a\\u65e0\\u6700\\u5c0f\\u9650\\u989d\\u3002\",\"exclude_products\":\"\\u6392\\u9664\\u4ea7\\u54c1\",\"max_users\":\"\\u6700\\u5927\\u7528\\u6237\\u6570\",\"max users. leave 0 for unlimited users\":\"\\u6700\\u5927\\u7528\\u6237\\u6570\\u3002\\u79bb\\u5f000\\u4e3a\\u65e0\\u9650\\u7528\\u6237\",\"use_once_per_customer\":\"\\u6bcf\\u5ba2\\u6237\\u4f7f\\u7528\\u4e00\\u6b21\",\"update\":\"\\u66f4\\u65b0\",\"edit_coupon\":\"\\u7f16\\u8f91\\u4f18\\u60e0\\u5238\",\"add_coupon\":\"\\u6dfb\\u52a0\\u4f18\\u60e0\\u5238\",\"licences_dashboard\":\"\\u8bb8\\u53ef\\u8bc1\\u4eea\\u8868\\u677f\",\"user\":\"\\u7528\\u6237\",\"licences_list\":\"\\u8bb8\\u53ef\\u8bc1\\u6e05\\u5355\",\"eg: standard licence\":\"\\u4f8b\\u5982\\uff1a\\u6807\\u51c6\\u8bb8\\u53ef\\u8bc1\",\"enter decription\":\"\\u8f93\\u5165\\u8bf4\\u660e\",\"day(s)\":\"\\u5929\\uff09\",\"month(s)\":\"\\u4e00\\u4e2a\\u6708\\uff08\\u53bf\\uff09\",\"year(s)\":\"\\u5e74\\u4efd\\uff09\",\"duration_type\":\"\\u6301\\u7eed\\u65f6\\u95f4\\u7c7b\\u578b\",\"add_licence\":\"\\u6dfb\\u52a0\\u8bb8\\u53ef\\u8bc1\",\"edit_licence\":\"\\u7f16\\u8f91\\u8bb8\\u53ef\\u8bc1\",\"s.no\":\"S.no\",\"add offers\":\"\\u6dfb\\u52a0\\u4f18\\u60e0\",\"offer_name\":\"\\u4f18\\u60e0\\u540d\\u79f0\",\"start date\":\"\\u5f00\\u59cb\\u65e5\\u671f\",\"please select product\":\"\\u8bf7\\u9009\\u62e9\\u4ea7\\u54c1\",\"product\":\"\\u4ea7\\u54c1\",\"use_product_title\":\"\\u4f7f\\u7528\\u4ea7\\u54c1\\u6807\\u9898\",\"use_product_description\":\"\\u4f7f\\u7528\\u4ea7\\u54c1\\u8bf4\\u660e\",\"use_product_image\":\"\\u4f7f\\u7528\\u4ea7\\u54c1\\u56fe\\u7247\",\"description for the offer\":\"\\u62a5\\u4ef7\\u8bf4\\u660e\",\"users_dashboard\":\"\\u7528\\u6237\\u4eea\\u8868\\u677f\",\"all_users\":\"\\u5168\\u90e8\\u7528\\u6237\",\"create_user\":\"\\u521b\\u5efa\\u7528\\u6237\",\"owner users\":\"\\u4e1a\\u4e3b\\u7528\\u6237\",\"role\":\"\\u89d2\\u8272\"}', '2017-04-17 08:00:24', '2017-05-22 10:36:27'),
(25, 'Japanese', 'japanese-5', 'jpn', 0, 0, 0, '{\"success\":\"Success\",\"record_updated_successfully\":\"Record Updated Successfully\",\"languages\":\"Languages\",\"home\":\"Home\",\"create\":\"Create\",\"language\":\"Language\",\"code\":\"Code\",\"default_language\":\"Default Language\",\"action\":\"Action\",\"are_you_sure\":\"Are You Sure\",\"you_will_not_be_able_to_recover_this_record\":\"You Will Not Be Able To Recover This Record\",\"yes\":\"Yes\",\"delete_it\":\"Delete It\",\"no\":\"No\",\"cancel_please\":\"Cancel Please\",\"deleted\":\"Deleted\",\"sorry\":\"Sorry\",\"cannot_delete_this_record_as\":\"Cannot Delete This Record As\",\"your_record_has_been_deleted\":\"Your Record Has Been Deleted\",\"cancelled\":\"Cancelled\",\"your_record_is_safe\":\"Your Record Is Safe\",\"toggle navigation\":\"Toggle Navigation\",\"profile\":\"Profile\",\"sign out\":\"Sign Out\",\"online\":\"Online\",\"dashboard\":\"Dashboard\",\"users\":\"Users\",\"all\":\"All\",\"owners\":\"Owners\",\"admins\":\"Admins\",\"executives\":\"Executives\",\"vendors\":\"Vendors\",\"customers\":\"Customers\",\"add\":\"Add\",\"import\":\"Import\",\"list\":\"List\",\"coupons\":\"Coupons\",\"licences\":\"Licences\",\"templates\":\"Templates\",\"offers\":\"Offers\",\"pages\":\"Pages\",\"payment_reports\":\"Payment Reports\",\"online_reports\":\"Online Reports\",\"offline_reports\":\"Offline Reports\",\"export\":\"Export\",\"free_bies\":\"Free Bies\",\"menus\":\"Menus\",\"settings\":\"Settings\",\"enable\":\"Enable\",\"set_default\":\"Set Default\",\"disable\":\"Disable\",\"user_statistics\":\"User Statistics\",\"view_all\":\"View All\",\"total_sales\":\"Total Sales\",\"total_revenue\":\"Total Revenue\",\"update_strings\":\"Update Strings\",\"update\":\"Update\",\"edit_language\":\"Edit Language\",\"language_title\":\"Language Title\",\"this_field_is_required\":\"This Field Is Required\",\"the_text_is_too_short\":\"The Text Is Too Short\",\"the_text_is_too_long\":\"The Text Is Too Long\",\"language_code\":\"Language Code\",\"supported_language_codes\":\"Supported Language Codes\",\"is_rtl\":\"Is Rtl\"}', '2017-05-22 10:34:08', '2017-05-22 10:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `licences`
--

CREATE TABLE `licences` (
  `id` int(11) NOT NULL,
  `slug` varbinary(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `duration_type` enum('Month(s)','Year(s)','Day(s)') DEFAULT 'Month(s)',
  `price` decimal(10,2) DEFAULT '0.00',
  `description` text,
  `user_created` int(11) UNSIGNED DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licences`
--


-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `display_dynamic_pages` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `description`, `display_dynamic_pages`) VALUES
(2, 'Useful Links', 'useful-links', 'active', '2017-03-27 05:55:26', '2017-04-03 12:32:57', 'Useful Links', 'no'),
(3, 'Main Menu', 'main-menu', 'active', '2017-03-27 07:49:05', '2017-03-28 11:43:26', '', 'yes'),
(4, 'Our Services', 'our-services', 'active', '2017-03-27 07:55:43', '2017-04-17 09:05:06', 'OUR SERVICES', 'no'),
(6, 'Digi Menu', 'digi-menu', 'active', '2017-03-27 08:09:30', '2017-03-27 08:09:30', '', 'no'),
(10, 'Contact', 'contact', 'active', '2017-04-13 10:47:09', '2017-04-19 13:12:07', '', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `description` text COLLATE utf8mb4_unicode_ci,
  `page_id` char(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `menu_active_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pages` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `slug`, `url`, `target`, `icon_class`, `color`, `parent_id`, `menu_order`, `created_at`, `updated_at`, `route`, `parameters`, `status`, `description`, `page_id`, `menu_active_title`, `pages`) VALUES
(12, 2, 'Privacy and Policy', 'privacy-and-policy', 'page/privacy-and-policy', '_blank', NULL, NULL, NULL, 4, '2017-03-27 06:58:18', '2017-04-20 06:02:30', NULL, NULL, 'active', '', '0', 'Privacy and Policy', 'null'),
(13, 2, 'Terms & Conditions', 'terms-conditions', 'page/terms-and-conditions', '_blank', NULL, NULL, NULL, 1, '2017-03-27 07:17:30', '2017-04-07 07:15:39', NULL, NULL, 'active', '', '0', 'Terms & Conditions', 'null'),
(14, 2, 'About', 'about-20', 'page/about-us', '_blank', NULL, NULL, NULL, 1, '2017-03-27 07:32:26', '2017-05-20 11:31:00', NULL, NULL, 'active', '<p>dsdsdsds</p>\r\n', '0', 'About Us Footer', 'null'),
(15, 2, 'How It Works', 'how-it-works-20', 'page/how-it-works', '_blank', NULL, NULL, NULL, 2, '2017-03-27 07:33:02', '2017-05-20 11:31:36', NULL, NULL, 'active', '', '0', 'Contact Us', 'null'),
(21, 3, 'Products', 'products', 'products-display', '_self', NULL, NULL, NULL, 2, '2017-03-27 07:51:09', '2017-05-16 06:07:42', NULL, NULL, 'active', '', '0', 'Products', 'null'),
(22, 3, 'ABOUT US', 'about-us', 'page/about-us', '_self', NULL, NULL, NULL, 5, '2017-03-27 07:52:03', '2017-05-11 06:13:06', NULL, NULL, 'active', '', '0', 'About Us vishnu', 'null'),
(23, 3, 'FAQs', 'faqs', 'faq', '_self', NULL, NULL, NULL, 4, '2017-03-27 07:53:04', '2017-05-11 06:12:57', NULL, NULL, 'active', '', '0', 'faqs', 'null'),
(27, 4, 'Sales', 'sales', '/', '_blank', NULL, NULL, NULL, 0, '2017-03-27 07:56:22', '2017-04-20 08:53:42', NULL, NULL, 'active', '', '0', 'sales', 'null'),
(28, 4, 'Purchases', 'purchases', '/', '_blank', NULL, NULL, NULL, 1, '2017-03-27 08:04:08', '2017-04-20 08:53:54', NULL, NULL, 'active', '', '0', 'Purchases', 'null'),
(29, 4, 'Downloads', 'downloads', '/', '_blank', NULL, NULL, NULL, 3, '2017-03-27 08:04:40', '2017-05-11 05:46:56', NULL, NULL, 'active', '', NULL, 'Downloads', 'null'),
(30, 4, 'Uploads', 'uploads', '/', '_blank', NULL, NULL, NULL, 2, '2017-03-27 08:05:01', '2017-04-20 06:16:16', NULL, NULL, 'active', '<p>sdfsfsf</p>\r\n', '0', 'Uploads', 'null'),
(32, 6, 'EDD MARKET PLACE', 'edd-market-place-24', 'EDD Market Place', '_blank', NULL, NULL, NULL, 0, '2017-03-27 08:10:05', '2017-05-20 11:18:53', NULL, NULL, 'active', '<p>We have 15 years of experience -&nbsp;running by young and passionate web-lovers with a straightforward vision. We loves to work on&nbsp;...</p>\r\n\r\n<p><a href=\"https://www.google.co.in/maps/place/Conquerors+Software+Technologies+Pvt+Limited/@17.4514725,78.385443,15z/data=!4m5!3m4!1s0x0:0x395c19037172a40!8m2!3d17.4514725!4d78.385443\" target=\"_blank\">Go To Google Maps</a></p>\r\n', '0', 'EDD', 'null'),
(35, 3, 'Pages', 'pages-18', 'page/{slug}', '_self', NULL, NULL, NULL, 6, '2017-03-28 11:55:14', '2017-05-20 08:54:58', NULL, NULL, 'active', '', 'pages', 'pages', '[\"9\",\"2\",\"8\",\"3\",\"4\"]'),
(39, 10, 'Contact Footer', 'contact-footer', 'sdfsadf', '_self', NULL, NULL, NULL, 3, '2017-04-13 10:50:11', '2017-04-18 06:24:47', NULL, NULL, 'active', '<p><strong>ADDRESS :</strong>&nbsp;Cyber Towers, Plot no 16 3rd floor Triveni Towers, Hitech City Rd, Silicon Valley, HITEC City, Hyderabad, Telangana 500081</p>\r\n\r\n<p><strong>PHONE :&nbsp;</strong>040 4241 0154</p>\r\n\r\n<p><strong>EMAIL:&nbsp;</strong><a href=\"mailto:info@conquerorstech.net\" target=\"_blank\">info@conquerorstech.net</a></p>\r\n', '0', 'Contact Footer', 'null'),
(42, 3, 'LOGIN', 'login-15', 'login', '_self', NULL, NULL, NULL, 7, '2017-05-08 01:22:46', '2017-05-11 06:13:30', NULL, NULL, 'active', '', '0', 'LOGIN', 'null'),
(44, 3, 'HOME', 'home-17', '.', '_self', NULL, NULL, NULL, 1, '2017-05-11 06:03:31', '2017-05-11 06:03:31', NULL, NULL, 'active', '', '0', 'HOME', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messenger_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `messenger_participants`
--

CREATE TABLE `messenger_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messenger_participants`
--


-- --------------------------------------------------------

--
-- Table structure for table `messenger_threads`
--

CREATE TABLE `messenger_threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messenger_threads`
--


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
(5, '2017_01_26_035735_create_applicationstatus_table', 4),
(6, '2014_10_28_175635_create_threads_table', 5),
(7, '2014_10_28_175710_create_messages_table', 5),
(8, '2014_10_28_180224_create_participants_table', 5),
(9, '2014_11_03_154831_add_soft_deletes_to_participants_table', 5),
(10, '2014_12_04_124531_add_softdeletes_to_threads_table', 5),
(11, '2017_01_27_144945_categories', 5),
(12, '2017_01_27_145108_create_categories_table', 6),
(13, '2017_03_20_102449_create_shoppingcart_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `modulehelper`
--

CREATE TABLE `modulehelper` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `help_link_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Help Me',
  `help_link_url` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(4) NOT NULL DEFAULT '1',
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `steps` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modulehelper`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(126) DEFAULT NULL,
  `slug` varchar(126) DEFAULT NULL,
  `permissions` varchar(126) DEFAULT 'Add,Edit,Delete,View',
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `slug`, `permissions`, `status`) VALUES
(1, 'Products', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(2, 'Users', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(3, 'Users_Owners', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(4, 'Users_Admins', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(5, 'Users_Executives', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(6, 'Users_Vendors', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(7, 'Users_Customers', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(8, 'Categories', NULL, 'Add,Edit,Delete,View,Import', 'active'),
(9, 'Coupons', NULL, 'Add,Edit,Delete,View', 'active'),
(10, 'Licences', NULL, 'Add,Edit,Delete,View', 'active'),
(11, 'Email_Templates', NULL, 'Add,Edit,Delete,View', 'active'),
(12, 'Offers', NULL, 'Add,Edit,Delete,View', 'active'),
(13, 'Pages', NULL, 'Add,Edit,Delete,View', 'active'),
(14, 'Faq', NULL, 'Add,Edit,Delete,View', 'active'),
(15, 'Payments_Report', NULL, 'Add,Edit,Delete,View,Export', 'active'),
(16, 'Menus', NULL, 'Add,Edit,Delete,View', 'active'),
(17, 'Site_Settings', NULL, 'Add,Edit,Delete,View', 'active'),
(18, 'Email_Settings', NULL, 'Add,Edit,Delete,View', 'active'),
(20, 'Cart_Settings', NULL, 'Add,Edit,Delete,View', 'active'),
(21, 'Seo_Settings', NULL, 'Add,Edit,Delete,View', 'active'),
(22, 'Payment_Gateways', NULL, 'Add,Edit,Delete,View', 'active'),
(23, 'Languages', NULL, 'Add,Edit,Delete,View,Change', 'active'),
(24, 'Messages', NULL, 'Add,Edit,Delete,View', 'active'),
(39, 'Change_Password', NULL, 'Edit', 'active'),
(53, 'Settings', NULL, 'Add,Edit,Delete,View', 'active'),
(52, 'Menu_Items', NULL, 'Add,Edit,Delete,View', 'active'),
(51, 'Profile', NULL, 'Edit,View', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `title` varchar(256) DEFAULT NULL,
  `description` varchar(512) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `use_product_title` enum('yes','no') DEFAULT 'no',
  `use_product_description` enum('yes','no') DEFAULT 'no',
  `use_product_image` enum('yes','no') DEFAULT 'no',
  `start_date_time` datetime DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `offer_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('active','inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--


-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `slug` varchar(512) NOT NULL,
  `content` text NOT NULL,
  `meta_tag_title` varchar(512) NOT NULL,
  `meta_tag_description` varchar(512) NOT NULL,
  `meta_tag_keywords` varchar(512) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `record_updated_by` int(11) DEFAULT NULL,
  `show_in_menu` enum('yes','no') DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `status`, `created_at`, `updated_at`, `record_updated_by`, `show_in_menu`, `icon`) VALUES
(9, 'About Us', 'about-us', '<p><img alt=\"\" src=\"http://conquerorstech.net/images/about-us-banner.jpg\" style=\"margin:0px\" /></p>\r\n\r\n<h2><a href=\"http://conquerorstech.net/index.php/about-us.html\">About Us</a></h2>\r\n\r\n<p>At Conquerors, We have highly experienced team of Product Architects, Product Managers, Senior Developers, Data Scientists, UI/UX Developers, Testers and passionate to build Custom Software Products and Mobile apps. We are on a mission to impact and transform everyday business challenges of client base globally with root level software applications.</p>\r\n\r\n<div style=\"background:url(&quot;../images/plus.png&quot;) 98.8% center no-repeat #eeeeee, -webkit-linear-gradient(top, #ffffff, #e6e6e6) 98.8%; border:0px; padding:0px 15px\">WHAT WE DO&hellip;</div>\r\n\r\n<p>Conquerors have hands on experience team in the following departments</p>\r\n\r\n<ul>\r\n	<li>Custom Software Applications Development.</li>\r\n	<li>Mobility &ndash; Hybrid and Native Applications.</li>\r\n	<li>Web Applications Development like Rich Internet Applications, E-Commerce and CMS-Word Press</li>\r\n	<li>Data Science and Machine Learning.</li>\r\n	<li>Digital Marketing &ndash; Search Engine Optimization and Social Media Promotions.</li>\r\n</ul>\r\n\r\n<div style=\"background:url(&quot;../images/plus.png&quot;) 98.8% center no-repeat #eeeeee, -webkit-linear-gradient(top, #ffffff, #e6e6e6) 98.8%; border:0px; padding:0px 15px\">OUR VALUES</div>\r\n\r\n<p>We work together with our clients from around the world as Technical Partners</p>\r\n\r\n<ul>\r\n	<li>To deliver the right solution, at the right price.</li>\r\n	<li>We are open and honest in our communication.</li>\r\n	<li>Sharing information and knowledge and clear insight into options, status, pricing and timescales.</li>\r\n	<li>We are committed to our clients to ensure they obtain the highest possible standards of service and quality of product.</li>\r\n	<li>We act with integrity&hellip; Constantly striving to uphold the highest professional standards.</li>\r\n</ul>\r\n\r\n<p>We believe in what we do. When you find yourself about to make a decision on your next Mobile app, Web development project, Digital Marketing, choose Conquerors. Why? Because we work to exceed your expectations and secondly because we intend to take the &lsquo;Love of God&rsquo; to the ends of the earth... so when we work with you&rsquo;ll be sure that we have an eternal goal and you are a part of it.</p>\r\n', '', '', '', 'Active', '2017-04-13 11:08:26', '2017-04-20 07:56:54', 10150, 'yes', 'fa-address-card-o'),
(2, 'How It Works', 'how-it-works', '<h2>How Does This Work</h2>\r\n\r\n<p><img alt=\"\" src=\"http://dev.mindsworthy.com/tutorsci/assets/front/images/step1.png\" /></p>\r\n\r\n<p>1</p>\r\n\r\n<p>Start Your Search</p>\r\n\r\n<p>Search for online tutoring. Need help with your search? Request a tutor and we&rsquo;ll have tutors contact you very soon!</p>\r\n\r\n<p><img alt=\"\" src=\"http://dev.mindsworthy.com/tutorsci/assets/front/images/step2.png\" /></p>\r\n\r\n<p>2</p>\r\n\r\n<p>Review</p>\r\n\r\n<p>Read feedback and ratings from parents and students. Detailed tutor profiles also include photos more.</p>\r\n\r\n<p><img alt=\"\" src=\"http://dev.mindsworthy.com/tutorsci/assets/front/images/step3.png\" /></p>\r\n\r\n<p>3</p>\r\n\r\n<p>Schedule</p>\r\n\r\n<p>Communicate directly with tutors to find a time that works for you. Whether you need a single lesson.</p>\r\n\r\n<p><img alt=\"\" src=\"http://dev.mindsworthy.com/tutorsci/assets/front/images/step4.png\" /></p>\r\n\r\n<p>4</p>\r\n\r\n<p>Start Learning</p>\r\n\r\n<p>One-on-one instruction is the most effective way to learn. Let us handle payments and administrative details.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', '', '', 'Active', NULL, '2017-03-30 13:16:21', 1, 'yes', 'fa-search-minus'),
(8, 'Offers', 'offers', '<p>Lorem Ipsum is simply <em>dummy text</em> of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard <em>dummy text</em> ever since the 1500s,</p>\r\n', '', '', '', 'Active', '2017-04-01 06:03:29', '2017-04-19 13:06:57', 1, 'yes', 'fa-tags'),
(3, 'Terms and Conditions', 'terms-and-conditions', '<p><strong>Terms and Conditions</strong></p>\r\n\r\n<p>These are the terms and condition</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', '', '', 'Active', NULL, '2017-04-03 11:22:12', 1, 'yes', 'fa-wpforms'),
(4, 'Privacy and Policy', 'privacy-and-policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n', '', '', '', 'Active', NULL, '2017-04-03 11:18:51', 1, 'yes', 'fa-user-secret');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--


-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `payment_gateway` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Final Amount need to paid (Item Price + Tax + Licence - Discount)',
  `cart_total` decimal(10,2) DEFAULT '0.00' COMMENT 'Item Price + Tax',
  `item_price` decimal(10,2) DEFAULT '0.00',
  `tax` decimal(10,2) DEFAULT '0.00',
  `licence_price` decimal(10,2) DEFAULT '0.00',
  `discount_amount` decimal(10,2) DEFAULT '0.00',
  `coupon_id` int(11) DEFAULT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_details` text COLLATE utf8_unicode_ci,
  `transaction_record` text COLLATE utf8_unicode_ci,
  `notes` text COLLATE utf8_unicode_ci,
  `admin_comments` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_first_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_last_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_billing_address1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_billing_address2` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_billing_city` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_billing_zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_billing_state` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_billing_country` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_details` text COLLATE utf8_unicode_ci,
  `licences` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--


-- --------------------------------------------------------

--
-- Table structure for table `payments_items`
--

CREATE TABLE `payments_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` int(10) UNSIGNED DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_slug` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `item_image` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `coupon_applied` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '0',
  `coupon_id` int(20) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `after_discount` decimal(10,2) NOT NULL,
  `licence_applied` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `licence_fee` decimal(10,2) DEFAULT NULL,
  `final_amount` decimal(10,2) NOT NULL,
  `other_details` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `licence_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `payments_items_downloads`
--

CREATE TABLE `payments_items_downloads` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `browser_agent` varchar(512) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments_items_downloads`
--


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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price_type` enum('default','variable') COLLATE utf8_unicode_ci DEFAULT 'default',
  `price` decimal(10,2) NOT NULL,
  `price_variations` text COLLATE utf8_unicode_ci,
  `price_display_type` enum('checkbox','radio') COLLATE utf8_unicode_ci DEFAULT 'checkbox',
  `download_files` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci DEFAULT 'Active',
  `meta_tag_title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_tag_description` text COLLATE utf8_unicode_ci,
  `meta_tag_keywords` text COLLATE utf8_unicode_ci,
  `user_created` int(11) UNSIGNED DEFAULT NULL,
  `categories` text COLLATE utf8_unicode_ci,
  `demo_link` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `download_limits` int(11) DEFAULT NULL COMMENT '0 for unlimited',
  `download_notes` text COLLATE utf8_unicode_ci,
  `is_featured` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'no',
  `views_count` int(11) DEFAULT '0',
  `licences` text COLLATE utf8_unicode_ci,
  `licence_of_use` text COLLATE utf8_unicode_ci,
  `technical_info` text COLLATE utf8_unicode_ci,
  `product_format` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_belongsto` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `product_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved` enum('1','0') COLLATE utf8_unicode_ci DEFAULT NULL,
  `approved_by` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--


-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `category_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `products_lisences`
--

CREATE TABLE `products_lisences` (
  `product_id` int(20) NOT NULL,
  `lisence_id` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_lisences`
--


-- --------------------------------------------------------

--
-- Table structure for table `product_items_ratings`
--

CREATE TABLE `product_items_ratings` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL COMMENT 'Rating out of 5',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'owner', 'Owner', 'Owner role', '2017-01-24 01:33:44', '2017-01-24 01:33:44'),
(2, 'admin', 'Admin', 'Administrator', '2017-01-25 17:20:42', '2017-01-25 17:22:01'),
(3, 'executive', 'Executive', NULL, '2017-01-25 17:22:52', '2017-01-25 17:22:52'),
(4, 'vendor', 'Vendor', NULL, '2017-01-25 23:31:57', '2017-01-25 23:31:57'),
(5, 'user', 'User', NULL, '2017-01-25 23:31:57', '2017-01-25 23:31:57');

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



-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `settings_data` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `key`, `slug`, `image`, `settings_data`, `description`, `created_at`, `updated_at`, `parent_id`, `status`) VALUES
(1, 'Email Settings', 'email_settings', 'email-settings', NULL, '{\"mail_driver\":{\"value\":\"smtp\",\"type\":\"select\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Driver\"},\"mail_host\":{\"value\":\"mail.cmdemolabs.com\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Host\"},\"mail_port\":{\"value\":\"25\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Port no\"},\"mail_username\":{\"value\":\"test@cmdemolabs.com\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Username\"},\"mail_password\":{\"value\":\"9866211858\",\"type\":\"password\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Password\"},\"mail_encryption\":{\"value\":\"tls\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"Mail Encryption\"},\"mailchimp_apikey\":{\"value\":\"2d170d64780e8beebb2fb2351cf0981a-us2\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"mailchimp_apikey\"},\"mailchimp_list_id\":{\"value\":\"9d241c177b\",\"type\":\"text\",\"extra\":{\"total_options\":\"8\",\"options\":{\"smtp\":\"SMTP\",\"mail\":\"Mail\",\"sparkpost\":\"Sparkpost\",\"sendmail\":\"Sendmail\",\"mailgun\":\"Mailgun\",\"mandrill\":\"Mandrill\",\"ses\":\"SES\",\"log\":\"Log\"}},\"tool_tip\":\"mailchimp_list_id\"}}', 'Contains all the settings related to emails', '2016-08-29 05:25:26', '2017-05-18 09:39:14', 0, 'active'),
(4, 'Paypal', 'paypal', 'paypal', 'DlJ4so8IKt1vV1F.png', '{\"email\":{\"value\":\"adiyya@gmail.com\",\"type\":\"email\",\"extra\":\"\",\"tool_tip\":\"Paypal Email\"},\"currency\":{\"value\":\"USD\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Default Currency\"},\"image\":{\"value\":\"mTc5BjI7AzuHow5.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Image to display at Paypal payment gateway\"},\"account_type\":{\"value\":\"sandbox\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"sandbox\":\"Sandbox\",\"live\":\"Live\"}},\"tool_tip\":\"Account Type Development (sandbox)\\/ Production (live)\"},\"status\":{\"value\":\"active\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"active\":\"Active\",\"inactive\":\"In-Active\"}},\"tool_tip\":\"Paypal Status\"}}', 'Contains paypal config details', '2016-09-08 09:08:30', '2017-05-11 05:25:29', 8, 'active'),
(5, 'PayU', 'payu', 'payu', NULL, '{\"payu_merchant_key\":{\"value\":\"do3vAdBt\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Merchent Key\"},\"payu_salt\":{\"value\":\"O0nqoiMiY7\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Salt\"},\"payu_working_key\":{\"value\":\"4941163\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"PayU Working Key\"},\"payu_testmode\":{\"value\":\"true\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"true\":\"Yes\",\"false\":\"No\"}},\"tool_tip\":\"Set PayU in Test Mode\"},\"status\":{\"value\":\"active\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"active\":\"Active\",\"inactive\":\"In-Active\"}},\"tool_tip\":\"Payu Status\"}}', 'Payu Settings', '2016-09-09 06:55:33', '2017-05-11 05:25:44', 8, 'active'),
(6, 'Site Settings', 'site_settings', 'site-settings', NULL, '{\"site_title\":{\"value\":\"EDD Market Place\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Site Title\"},\"site_logo\":{\"value\":\"XOYfD4y5zxIPYk5.png\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Site Logo\"},\"site_address\":{\"value\":\"849 South Three Notch St.\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Address\"},\"site_city\":{\"value\":\"California\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"City\"},\"site_favicon\":{\"value\":\"qyVT1iMBK1QsPvA.ico\",\"type\":\"file\",\"extra\":\"\",\"tool_tip\":\"Favicon\"},\"site_state\":{\"value\":\"California\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"State\"},\"site_country\":{\"value\":\" U.S\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Country\"},\"site_zipcode\":{\"value\":\"36420\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Postal Code\"},\"site_phone\":{\"value\":\"12345678978\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Phone\"},\"welcome_page_heading\":{\"value\":\"EDD Market Place\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Welcome Page Heading\"},\"welcome_page_sub_heading\":{\"value\":\"EDD Market Place\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Welcome Page Sub Heading\"},\"welcome_page_another_heading\":{\"value\":\"Products Available From $1\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Welcome Page another Heading\"},\"system_timezone\":{\"value\":\"Asia\\/Kolkata\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Refer http:\\/\\/php.net\\/manual\\/en\\/timezones.php\"},\"currency_code\":{\"value\":\"INR\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Add your currency code\"},\"terms_and_conditions\":{\"value\":\"Terms and Conditions here  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"terms_and_conditions\"},\"privacy_policy\":{\"value\":\"Privacy Policy here Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"privacy_policy\"},\"date_format\":{\"value\":\"YYYY-MM-DD\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Date format. Please refer PHP date manual (http:\\/\\/php.net\\/manual\\/en\\/function.date.php)\"},\"facebook\":{\"value\":\"https:\\/\\/en-gb.facebook.com\\/\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Facebook\"},\"twitter\":{\"value\":\"https:\\/\\/twitter.com\\/\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Twitter\"},\"googleplus\":{\"value\":\"https:\\/\\/plus.google.com\\/\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Plus\"},\"linkedin\":{\"value\":\"https:\\/\\/www.linkedin.com\\/company\\/login\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Linkedin\"},\"dribble\":{\"value\":\"https:\\/\\/dribbble.com\\/session\\/new\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Dribble\"},\"pinterest\":{\"value\":\"https:\\/\\/www.pinterest.com\\/pinterest\\/\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Pinterest\"},\"copy_rights\":{\"value\":\"<p>COPYRIGHTS <span class=\\\"fa fa-copyright\\\"><\\/span> 2017 ALL RIGHTS RESERVED BY - <span>EDD MARKET PLACE<\\/span> <\\/p>\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Copy Rights\"},\"admin_commission_for_a_vendor_product\":{\"value\":\"5\",\"type\":\"number\",\"extra\":\"\",\"tool_tip\":\"Admin commission for a vendor product in percentage\"}}', 'Here you can manage the title, logo, favicon and all general settings', '2016-09-29 12:16:54', '2017-05-22 07:40:24', 0, 'active'),
(7, 'Seo Settings', 'seo_settings', 'seo-settings-1', NULL, '{\"meta_description\":{\"value\":\"Digi Downloads\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Site Meta Description\"},\"meta_keywords\":{\"value\":\"Exam system|exam|exams\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Site Meta Keywords\"},\"google_analytics\":{\"value\":\"<!-- Google Analytics -->\\r\\n<script>\\r\\n(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){\\r\\n(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\\r\\nm=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\\r\\n})(window,document,\'script\',\'https:\\/\\/www.google-analytics.com\\/analytics.js\',\'ga\');\\r\\n\\r\\nga(\'create\', \'UA-XXXXX-Y\', \'auto\');\\r\\nga(\'send\', \'pageview\');\\r\\n<\\/script>\\r\\n<!-- End Google Analytics -->\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"Update your google analytics code\"}}', 'Contains all SEO settings', '2016-09-30 19:03:46', '2017-04-03 07:45:41', 0, 'active'),
(8, 'Payment Gateways', 'payment_gateways', 'payment-gateways', NULL, '{\"offline_payment_information\":{\"value\":\"1) Pay the amount through DD\\/Check\\/Deposit in favor of Admin, Academia, India <br\\/>\\r\\n2) Update the Payment information in the below box <br\\/>\\r\\n3) Admin will validate the payment details and update your subscription <br\\/>\",\"type\":\"textarea\",\"extra\":{\"total_options\":\"2\",\"options\":{\"enable\":\"Enable\",\"disable\":\"Disable\"}},\"tool_tip\":\"Information related to offline payment\"}}', 'Contains all list of payment gateways in the system and the status of availability ', '2016-10-02 15:18:19', '2017-04-12 06:24:48', 0, 'active'),
(12, 'Social Logins', 'social_logins', 'social-logins', NULL, '{\"facebook_client_id\":{\"value\":\"649337055234832\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Facebook Client ID\"},\"facebook_client_secret\":{\"value\":\"5a67e2912d64971af65c4c05b0c6b2ae\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Facebook Client Secret\"},\"facebook_redirect_url\":{\"value\":\"http:\\/\\/conquerorslabs.com\\/exam2\\/auth\\/facebook\\/callback\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"It should be http (or) https:\\/\\/yourservername\\/auth\\/google\\/callback\"},\"google_client_id\":{\"value\":\"881078848150-i20jdtp5g3pg9i2p4tgts4ao5i1ja6cv.apps.googleusercontent.com\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Plus Client ID\"},\"Google_client_secret\":{\"value\":\"ndH8wRWVaB6Mv6pICFRPIhJr\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"Google Client Secret Key\"},\"google_redirect_url\":{\"value\":\"http:\\/\\/conquerorslabs.com\\/exam2\\/auth\\/google\\/callback\",\"type\":\"text\",\"extra\":\"\",\"tool_tip\":\"http (or) https:\\/\\/yourserver.com\\/auth\\/google\\/callback\"}}', 'Add/Update Settings for Social Logins (Facebook and Google plus)', '2016-10-28 16:26:37', '2016-10-28 11:42:05', 0, 'active'),
(13, 'Cart Settings', 'cart_settings', 'cart-settings', NULL, '{\"enable_taxes\":{\"value\":\"yes\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Enable Taxes\"},\"tax_rate_type\":{\"value\":\"percent\",\"type\":\"select\",\"extra\":{\"total_options\":\"1\",\"options\":{\"percent\":\"Percent\"}},\"tool_tip\":\"Tax Rate Type\"},\"tax_rate\":{\"value\":\"10\",\"type\":\"number\",\"extra\":{\"total_options\":\"1\",\"options\":{\"percent\":\"Percent\"}},\"tool_tip\":\"Tax Rate\"},\"prices_entered_with_tax\":{\"value\":\"no\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Prices entered with tax\"},\"display_tax_rate_on_prices\":{\"value\":\"no\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Display Tax Rate on Prices\"},\"display_during_checkout\":{\"value\":\"yes\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Display during checkout\"},\"currency_symbol\":{\"value\":\"$\",\"type\":\"text\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Currency Symbol\"},\"currency_code\":{\"value\":\"USD\",\"type\":\"text\",\"extra\":{\"total_options\":\"2\",\"options\":{\"yes\":\"Yes\",\"no\":\"No\"}},\"tool_tip\":\"Currency Code\"},\"currency_position\":{\"value\":\"beforewithspace\",\"type\":\"select\",\"extra\":{\"total_options\":\"4\",\"options\":{\"before\":\"Before ($20)\",\"beforewithspace\":\"Before with space ($ 20)\",\"after\":\"After (20$)\",\"afterwithspace\":\"After with space (20 $)\"}},\"tool_tip\":\"Currency Position\"},\"display_currency\":{\"value\":\"symbol\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"code\":\"Code\",\"symbol\":\"Symbol\"}},\"tool_tip\":\"Display Currency\"}}', 'Here you can manage Taxes and Currency', '2017-03-10 10:22:19', '2017-05-08 23:55:21', 0, 'active'),
(14, 'Offline Payment', 'offline_payment', 'offline-payment', NULL, '{\"offline_payment_information\":{\"value\":\"1) Pay the amount through DD\\/Check\\/Deposit in favour of Admin,Digi-Downloads,India\\r\\n\",\"type\":\"textarea\",\"extra\":\"\",\"tool_tip\":\"offline_payment_information\"},\"status\":{\"value\":\"active\",\"type\":\"select\",\"extra\":{\"total_options\":\"2\",\"options\":{\"active\":\"Active\",\"inactive\":\"In-Active\"}},\"tool_tip\":\"Offline Payment Status\"}}', '', '2017-03-13 08:55:58', '2017-04-17 06:12:22', 8, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('header','footer','content') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'content',
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `record_updated_by` int(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `template_type` enum('email','sms') COLLATE utf8_unicode_ci DEFAULT 'email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `title`, `slug`, `type`, `subject`, `content`, `from_email`, `from_name`, `record_updated_by`, `created_at`, `updated_at`, `template_type`) VALUES
(1, 'header', 'header', 'content', 'header', '<p>Email</p>\r\n<!-- Start of preheader -->\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody><!-- Spacing -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n					<tr>\r\n						<td>If you cannot read this email, please <a href=\"#\"> click here </a></td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!-- Spacing -->\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!-- End of preheader --><!-- start of header -->\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td><!-- logo -->\r\n						<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:280px\">\r\n							<tbody>\r\n								<tr>\r\n									<td>\r\n									<p><a href=\"#\"><img alt=\"logo\" src=\"http://conquerorslabs.com/menorah-college/uploads/settings/m6D8hKadoPCe1e0.png\" style=\"height:57px; width:180px\" /> </a></p>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						<!-- End of logo --><!-- menu -->\r\n\r\n						<table align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:280px\">\r\n							<tbody>\r\n								<tr>\r\n									<td><a href=\"#\">HOME </a> | <a href=\"#\"> ABOUT </a> | <a href=\"#\"> SHOP </a></td>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						<!-- End of Menu --></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!-- end of header -->', 'no@noemail.com', 'Test', 1, '2016-07-19 06:23:14', '2017-03-30 12:57:08', 'email'),
(2, 'footer', 'footer', 'footer', 'footer', '<div class=\"block\">\r\n    <!-- Start of preheader -->\r\n    <table bgcolor=\"#f6f4f5\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" st-sortable=\"postfooter\" width=\"100%\">\r\n        <tbody>\r\n            <tr>\r\n                <td width=\"100%\">\r\n                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" width=\"580\">\r\n                        <tbody>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td align=\"center\" st-content=\"preheader\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999\" valign=\"middle\">\r\n                                    If you don\'t want to receive updates. please\r\n                                    <a class=\"hlite\" href=\"#\" style=\"text-decoration: none; color: #0db9ea\">\r\n                                        unsubscribe\r\n                                    </a>\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                            <tr>\r\n                                <td height=\"5\" width=\"100%\">\r\n                                </td>\r\n                            </tr>\r\n                            <!-- Spacing -->\r\n                        </tbody>\r\n                    </table>\r\n                </td>\r\n            </tr>\r\n        </tbody>\r\n    </table>\r\n    <!-- End of preheader -->\r\n</div>', 'no@noemail.com', 'Test', 2, '2016-07-19 06:24:08', '2016-07-19 06:30:21', 'email'),
(4, 'registration', 'registration', 'content', 'Welcome', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear ,<br />\r\n									You have successfully registered With Digi Downloads.</p>\r\n\r\n									<p>The credentials are</p>\r\n\r\n									<p>Username:</p>\r\n\r\n									<p>Password:</p>\r\n\r\n									<p><a href=\"\">Click here</a>{{$confirmation_link}} to activate the account and enjoy the facilities provided by our system.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Digi Downloads', 1, '2016-07-29 03:48:18', '2017-04-28 10:17:07', 'email'),
(5, 'subscription', 'subscription', 'content', 'Subscription Successfull', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">Dear {{ $username }},<br />\r\n									You have successfully subscribed to {{ ucfirst($plan)}} plan with transaction {{$id}}. Enjoy the facilities provided by our system.</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Jack', 1, '2016-08-03 01:00:58', '2016-09-03 01:59:12', 'email'),
(6, 'offline_subscription_failed', 'offline-subscription-failed', 'content', 'Offline Subscription Failed', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your attempt for offline subscription is failed.</p>\r\n\r\n									<p>Please find the admin comment</p>\r\n\r\n									<p><u><strong>Admin Comment:</strong></u></p>\r\n\r\n									<p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:center\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 10:31:47', '2016-10-18 14:36:14', 'email'),
(7, 'offline_subscription_success', 'offline-subscription-success', 'content', 'Offline Subscription Success', '<div class=\"block\"><!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" id=\"backgroundTable\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your attempt for offline subscription is success. &nbsp;</p>\r\n\r\n									<p><u><strong>Admin Comment</strong></u></p>\r\n\r\n									<p>&nbsp;{{$admin_comment}}.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color: rgb(13, 185, 234); text-align: justify;\"><span style=\"color:#ffffff\"><a href=\"#\" style=\"color: #ffffff; text-align:center;text-decoration: none;\">Read More</a> </span></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-15 10:35:32', '2016-10-18 14:27:15', 'email'),
(8, 'subscription_success', 'subscription-success', 'content', 'Your Subscription was Success', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear {{ $username }},<br />\r\n									Your payment has beed completed and you can now download your products. &nbsp;</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<tr>\r\n									<td>Products</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									{!! $products !!}\r\n									</td>\r\n								</tr>\r\n								\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Admin', 1, '2016-10-19 15:31:21', '2016-10-19 15:31:21', 'email'),
(9, 'contactus_message', 'contactus-message', 'content', 'Enquiry', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear Owner,<br />\r\n									Your have received a new message from enquiries from your website. &nbsp;</p>\r\n\r\n									<p><strong>name:{{$name}}</strong></p>\r\n\r\n									<p><strong>Phone Number:{{$phone_number}}</strong></p>\r\n\r\n									<p><strong>Email:{{$from_email}}</strong></p>\r\n\r\n									<p><strong>message:{{$user_message}}</strong></p>\r\n\r\n									<p>Please contact this user for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'User', 1, '2017-03-30 05:11:51', '2017-04-25 11:28:13', 'email'),
(10, 'forgotpassword', 'forgotpassword', 'content', 'forgotpassword', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear ,<br />\r\n									You have successfully registered with .</p>\r\n\r\n									<p>The credentials are</p>\r\n\r\n									<p>Username:</p>\r\n\r\n									<p>Temporary Password:</p>\r\n\r\n									<p>You can <a href=\"http://conquerorslabs.com/digi-downloads/public/login\">login</a> with above details and can change password later</p>\r\n\r\n									<p>OR</p>\r\n\r\n									<p>Click <a href=\"http://conquerorslabs.com/digi-downloads/public/login\">here</a> to change you password.</p>\r\n\r\n									<p>Please contact admin for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'Admin', 1, NULL, '2017-04-25 12:02:48', 'email'),
(11, 'product_owner_contact', 'product-owner-contact-9', 'header', 'Product Details', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear Product Owner,<br />\r\n									Your have received a new message from enquiries from your website. &nbsp;</p>\r\n\r\n									<p><strong>name:</strong></p>\r\n\r\n									<p><strong>Phone Number:</strong></p>\r\n\r\n									<p><strong>Email:</strong></p>\r\n\r\n									<p><strong>message:</strong></p>\r\n\r\n									<p>Please contact this user for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@academia.com', 'User', 1, '2017-04-25 11:42:47', '2017-04-25 11:47:40', 'email'),
(12, 'product_adding', 'product-adding-10', 'content', 'Produc Adding Template', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear Owner,</p>\r\n\r\n									<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;A new product is adding in your site.The product details are&nbsp;</p>\r\n\r\n									<p>&nbsp;Product Name :</p>\r\n\r\n									<p>&nbsp;Price &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</p>\r\n\r\n									<p>&nbsp;Created By &nbsp; &nbsp; &nbsp;:</p>\r\n\r\n									<p>&nbsp;User Email &nbsp; &nbsp; &nbsp; :</p>\r\n\r\n									<p>&nbsp;</p>\r\n\r\n									<p>Please Approve This Product</p>\r\n\r\n									<p>Please contact this user for further details.</p>\r\n\r\n									<p>&nbsp;</p>\r\n\r\n									<p>&nbsp;</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@admin.com', 'owner', 1, '2017-05-03 07:21:33', '2017-05-03 08:55:40', 'email'),
(13, 'product_approve', 'product-approve-11', 'content', 'Your Product Is Approved', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Dear <strong>{{$user_name}}</strong>&nbsp;,<br />\r\n									Your product <strong>{{$product_name}}</strong> &nbsp;is approved by owner. &nbsp;</p>\r\n\r\n									<p>Please contact this owner for further details.</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@admin.com', 'owner', 1, '2017-05-03 09:01:02', '2017-05-03 09:34:34', 'email'),
(14, 'all_payments', 'all-payments-12', 'content', 'Check Payment', '<!-- Full + text -->\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:580px\">\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:540px\">\r\n							<tbody><!-- title -->\r\n								<tr>\r\n									<td style=\"text-align:left\">&nbsp;</td>\r\n								</tr>\r\n								<!-- end of title --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing --><!-- content -->\r\n								<tr>\r\n									<td style=\"text-align:left\">\r\n									<p>Hai Sir,</p>\r\n\r\n									<p>&nbsp;New payment is done by <strong>{{$user_name}}</strong> paid amount is <strong>{{$paid_amount}}</strong> through <strong>{{$payment_gateway}}</strong>.</p>\r\n\r\n									<p>So please check it once</p>\r\n\r\n									<p>&nbsp;</p>\r\n\r\n									<p>Please contact this user for further details.</p>\r\n\r\n									<p>&nbsp;</p>\r\n\r\n									<p>&nbsp;</p>\r\n									</td>\r\n								</tr>\r\n								<!-- end of content --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- button -->\r\n								<tr>\r\n									<td>\r\n									<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"height:30px\">\r\n										<tbody>\r\n											<tr>\r\n												<td style=\"background-color:#0db9ea; text-align:justify\"><a href=\"#\">Read More</a></td>\r\n											</tr>\r\n										</tbody>\r\n									</table>\r\n									</td>\r\n								</tr>\r\n								<!-- /button --><!-- Spacing -->\r\n								<tr>\r\n									<td>&nbsp;</td>\r\n								</tr>\r\n								<!-- Spacing -->\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'admin@admin.com', 'User', 1, '2017-05-03 10:02:17', '2017-05-03 10:02:17', 'email');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT '0' COMMENT '1 - Confirmed, 0 - Not confirmed',
  `confirmation_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'Registered' COMMENT 'Registered,Active,Suspended',
  `billing_address1` text COLLATE utf8_unicode_ci,
  `billing_address2` text COLLATE utf8_unicode_ci,
  `billing_city` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8_unicode_ci,
  `social_links` text COLLATE utf8_unicode_ci,
  `forgot_token` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_modules_permissions` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicationstatus`
--
ALTER TABLE `applicationstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`title`,`parent_id`);

--
-- Indexes for table `categories_empty`
--
ALTER TABLE `categories_empty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_countries`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free_bies`
--
ALTER TABLE `free_bies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `licences`
--
ALTER TABLE `licences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_created`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_participants`
--
ALTER TABLE `messenger_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messenger_threads`
--
ALTER TABLE `messenger_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modulehelper`
--
ALTER TABLE `modulehelper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_offers_product_id` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments_items`
--
ALTER TABLE `payments_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_id` (`payment_id`);

--
-- Indexes for table `payments_items_downloads`
--
ALTER TABLE `payments_items_downloads`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_image_unique` (`image`),
  ADD KEY `fk_users_id` (`user_created`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD KEY `fk_product_id` (`product_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `product_items_ratings`
--
ALTER TABLE `product_items_ratings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`),
  ADD UNIQUE KEY `settings_slug_unique` (`slug`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`identifier`,`instance`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `categories_empty`
--
ALTER TABLE `categories_empty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id_countries` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `free_bies`
--
ALTER TABLE `free_bies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `licences`
--
ALTER TABLE `licences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `messenger_participants`
--
ALTER TABLE `messenger_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `messenger_threads`
--
ALTER TABLE `messenger_threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `modulehelper`
--
ALTER TABLE `modulehelper`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `payments_items`
--
ALTER TABLE `payments_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `payments_items_downloads`
--
ALTER TABLE `payments_items_downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6290;
--
-- AUTO_INCREMENT for table `product_items_ratings`
--
ALTER TABLE `product_items_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tourapplications`
--
ALTER TABLE `tourapplications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10179;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `licences`
--
ALTER TABLE `licences`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `fk_offers_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments_items`
--
ALTER TABLE `payments_items`
  ADD CONSTRAINT `fk_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_users_id` FOREIGN KEY (`user_created`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

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
