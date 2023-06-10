-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 10 Cze 2023, 14:50
-- Wersja serwera: 8.0.33-0ubuntu0.20.04.2
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `BallroomSpotify`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_03_30_130429_create_song_table', 2),
(9, '2023_04_02_133911_create_playlist_table', 3),
(10, '2023_04_02_133937_create_playlist_songs_pivot_table', 3),
(11, '2023_04_03_111148_add_duration_table_to_songs', 4),
(12, '2023_04_05_130319_add_position_tableto_playlist_song', 5),
(14, '2023_04_06_100819_add_repetable_column_to_playlist_table', 6),
(15, '2023_04_08_081435_create_tag_table', 7),
(16, '2023_04_08_081509_create_pivot_song_tag_table', 7),
(17, '2023_05_29_112842_create_track_template_table', 8),
(18, '2023_05_29_120434_create_track_template_pivot_table', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `playlist`
--

CREATE TABLE `playlist` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `repeatable` tinyint(1) NOT NULL DEFAULT '0',
  `taggable` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `playlist`
--

INSERT INTO `playlist` (`id`, `name`, `description`, `created_at`, `updated_at`, `repeatable`, `taggable`, `image`) VALUES
(134, 'wprawki', '2023-06-02', '2023-06-02 07:32:43', '2023-06-02 07:32:43', 0, 0, 'storage/images/toFill/template_playlist.png'),
(135, 'ghg', '2023-06-02', '2023-06-02 14:03:06', '2023-06-02 14:03:06', 0, 0, 'storage/images/toFill/template_playlist.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `playlist_song`
--

CREATE TABLE `playlist_song` (
  `id` bigint UNSIGNED NOT NULL,
  `song_id` bigint UNSIGNED NOT NULL,
  `playlist_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `playlist_song`
--

INSERT INTO `playlist_song` (`id`, `song_id`, `playlist_id`, `created_at`, `updated_at`, `position`) VALUES
(444, 187, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 1),
(445, 139, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 2),
(446, 120, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 3),
(447, 127, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 4),
(448, 133, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 5),
(449, 232, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 6),
(450, 205, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 7),
(451, 180, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 8),
(452, 197, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 9),
(453, 183, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 10),
(454, 161, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 11),
(455, 190, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 12),
(456, 143, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 13),
(457, 116, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 14),
(458, 130, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 15),
(459, 231, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 16),
(460, 146, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 17),
(461, 211, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 18),
(462, 174, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 19),
(463, 230, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 20),
(465, 157, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 21),
(466, 189, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 22),
(467, 142, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 23),
(468, 118, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 24),
(469, 128, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 25),
(470, 135, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 26),
(471, 154, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 27),
(472, 203, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 28),
(473, 181, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 29),
(475, 184, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 31),
(476, 167, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 32),
(477, 195, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 33),
(478, 137, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 34),
(479, 115, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 35),
(480, 129, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 36),
(481, 136, 134, '2023-06-02 07:32:43', '2023-06-02 07:41:49', 37),
(483, 212, 134, '2023-06-02 07:36:16', '2023-06-02 07:41:49', 39),
(484, 199, 134, '2023-06-02 07:40:37', '2023-06-02 07:41:49', 30),
(485, 245, 134, '2023-06-02 07:41:28', '2023-06-02 07:41:49', 38),
(486, 188, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 1),
(487, 140, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 2),
(488, 116, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 3),
(489, 129, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 4),
(490, 231, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 5),
(491, 149, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 6),
(492, 207, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 7),
(493, 173, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 8),
(494, 200, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 9),
(495, 182, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 10),
(496, 50, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 11),
(497, 192, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 12),
(498, 137, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 13),
(499, 115, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 14),
(500, 127, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 15),
(501, 135, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 16),
(502, 148, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 17),
(503, 203, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 18),
(504, 174, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 19),
(505, 199, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 20),
(506, 184, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 21),
(507, 160, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 22),
(508, 195, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 23),
(509, 49, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 24),
(510, 118, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 25),
(511, 124, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 26),
(512, 131, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 27),
(513, 228, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 28),
(514, 209, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 29),
(515, 181, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 30),
(516, 230, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 31),
(517, 185, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 32),
(518, 159, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 33),
(519, 190, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 34),
(520, 143, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 35),
(521, 120, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 36),
(522, 130, 135, '2023-06-02 14:03:06', '2023-06-02 14:03:06', 37);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `song`
--

CREATE TABLE `song` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `song`
--

INSERT INTO `song` (`id`, `created_at`, `updated_at`, `title`, `author`, `image`, `src`, `duration`) VALUES
(47, '2023-04-06 06:32:23', '2023-04-06 06:32:23', 'Happy Feet', 'The Aviator Soundtrack', 'storage/images/songs/RkezWUooIRKEZr6RZXHnvOQwtf5ohSHcNt0DbScE.jpg', 'storage/music/EddPfLbYi9HCmGwtA9yvTbxEOHeGdKtconNwnGK2.bin', 179.853),
(48, '2023-04-06 06:46:17', '2023-04-06 06:46:17', 'Rock Around The Clock', 'Bill Haley', 'storage/images/songs/jQeu9zPOySMwvz56bsA5cy8P0NP2xRdCvQpwuADR.jpg', 'storage/music/CuqM5PXNDA7ODPhxOVVryLFlSUX8kmKstcdDQdNF.mp3', 129.936),
(49, '2023-04-06 06:49:43', '2023-04-06 06:49:43', 'Waltz per Eliza', 'Ballroom', 'storage/images/songs/C0VzKW4bfQMkh3Vna3uRMrY70WKla8XLeb9MVSQ7.jpg', 'storage/music/ri042l7xpWtw36JRzKG0f803QUQywy7yO4WIFD5S.mp3', 116.76),
(50, '2023-04-06 06:54:40', '2023-04-06 06:54:40', 'Crazy Little Things Called Love', 'Queen', 'storage/images/songs/vCFXLXjoKgg42RkrlrwtXSzrOVygM80AcH2mb46V.jpg', 'storage/music/f8nItAxA6yECBiXFVxdPEElR15JOW6QQ0IXjAyf1.mp3', 163.416),
(115, '2023-04-10 12:14:00', '2023-04-10 12:14:00', 'Carmen', 'Ballroom', 'storage/images/songs/iEKkPaLzB2qFYIEPg22QbIWbzyKUPe6vmWcPy27k.jpg', 'storage/music/Mfrhd4s6jnEjb2OUgSF6MSQEC7RHt1VcFqvFhuRB.mp3', 155.35),
(116, '2023-04-10 12:14:51', '2023-04-10 12:14:51', 'Essa', 'Ballroom', 'storage/images/songs/Q0p5WTMJK6CoU1gu7IJMB1bbwz9apHrCR1YoMakW.jpg', 'storage/music/i31ItuYoz1buhSjblUCBRAeWpKUdJdAfmNCSH045.mp3', 169.848),
(118, '2023-04-10 12:16:43', '2023-04-10 12:16:43', 'La Cumparsita', 'Ballroom', 'storage/images/songs/mHNhKC2t9Epk5MdIkXxA6egFiEda7mwJfZnsvEcS.jpg', 'storage/music/A8tUzUddgNPDLxv5P6KB4u2awBKk42qM9KxLioUU.mp3', 149.447),
(120, '2023-04-10 12:18:28', '2023-04-10 12:18:28', 'Sweet Dreams', 'Eurythmics', 'storage/images/songs/Chh6jxjGKFZSpxQbO0NtWhgTeNcQYTPQp628r88U.jpg', 'storage/music/YklesYKvFor6UUA0tGiB3qEGFoTKZqFUU8g9fYQu.mp3', 240.984),
(124, '2023-04-10 12:55:56', '2023-04-10 12:55:56', 'Amelie ', 'Tiersen', 'storage/images/songs/3AvkjAKqQmm7QIVnrBwVEkopcE8PzzdRXqQapgxb.jpg', 'storage/music/lYnBNP5tLaPD8uy1OiZPZVv8rzKO01Q2OnScWq8h.mp3', 135.912),
(125, '2023-04-10 12:57:13', '2023-04-10 12:57:13', 'La Foulie', 'Piaf', 'storage/images/songs/wKizWR4cjDutEqkPsH9623A4cn9FpT4TFCiodGTT.jpg', 'storage/music/qJxInOgTmrlWOtsobgyF8QivxuUsTSbzAdAOMKs0.mp3', 202.292),
(126, '2023-04-10 12:58:13', '2023-04-10 12:58:13', 'Noce i Dnie Walc', 'Noce i Dnie', 'storage/images/songs/NO64riQNIx0B7R2aqRiIOtllxKF9fVtBdBS6gOjh.jpg', 'storage/music/4aVKK8MRYP0Cg0Rs4M6wh7ivqBREwb3sQnrpxnLQ.mp3', 214.056),
(127, '2023-04-10 13:02:00', '2023-04-10 13:02:00', 'Perfect', 'Ed Sheeran', 'storage/images/songs/aNqf15MI6OQgtm9TUJKoxV1O1YXqH2UOGUb3jh1U.jpg', 'storage/music/qcnMy77w92ZKpAf3cfyD3VDcMBR9RwPr3HbVECbj.mp3', 264.229),
(128, '2023-04-10 13:04:23', '2023-04-10 13:04:23', 'Que Sera Sera', 'Doris Day', 'storage/images/songs/W5kBJRZOmgzuLo1u20MuAU3yJ7fH2bT8m6bsH9Er.png', 'storage/music/nY0DNwkXBIElVmYxZ072VsHTBzb0H3eWDv4oQV2H.mp3', 127.242),
(129, '2023-04-10 13:08:01', '2023-04-10 13:08:01', 'Second Waltz', 'Andre Rieu', 'storage/images/songs/EuIk7xwbxJXjWRPnOZOtzdkSPTWt5xq75qWCmn8v.jpg', 'storage/music/9jwzH07rH1WNLHh6llL3CdND3BBfIpmuVbcJqXgn.mp3', 220.238),
(130, '2023-04-10 13:08:31', '2023-04-10 13:08:31', 'Snowman', 'Sia', 'storage/images/songs/K4hpZjBlmsQokfDEqFtnnOtbCdCorN4iB6dGSk9j.jpg', 'storage/music/obMtyNm9b6jMCf6BgkHtJ7emiLIf1bAPqudjgREp.mp3', 165.46),
(131, '2023-04-11 06:27:43', '2023-04-11 06:27:43', 'All of me', 'Ballroom', 'storage/images/songs/bCmosUfz276LSvZ47qvd5sBdi4xVTz2TGhTwFmud.jpg', 'storage/music/Whzo6Eo5Erd2RJrBBamOCZ8RCP1Edx5uwMxkE01o.mp3', 300.069),
(132, '2023-04-11 06:28:34', '2023-04-11 06:28:34', 'Can\'t smile without you', 'Evans', 'storage/images/songs/CpHSyOnRdhtosRWxfrQH9RNHpnZl2w6kg7y5osoJ.jpg', 'storage/music/uBtCp9fuHhJRE69i2lPZrZcN4f7kNY4of3xhD0g3.mp3', 187.008),
(133, '2023-04-11 06:29:38', '2023-04-11 06:29:38', 'Lasciatemi Cantare', 'Toto Cutungo', 'storage/images/songs/FII8LhEbjKLZWQh02ztEncAzcOPzktbRFtBY0zIx.jpg', 'storage/music/lKe4c3D3zqhgA1Vl8DNEwVbWhqLSlYgHqjTiYA3H.mp3', 223.451),
(134, '2023-04-11 08:52:13', '2023-04-11 08:52:13', 'Dance Me to the End of Love', 'Cohen', 'storage/images/songs/NO2CBjGcs8yOV8Ns4Qnuo2GQuGvXrCoISl2614VU.jpg', 'storage/music/tY5YfVDc8GdK4yAoziECqirwqeQbtmeZMvD4YcZM.mp3', 281.339),
(135, '2023-04-11 08:53:31', '2023-04-11 08:53:31', 'Material Girl', 'Cassandra Beck', 'storage/images/songs/b4ENiIZyLN7nak9hQYCF9KZLIj4JVXgioCP0pYbT.jpg', 'storage/music/Us4ylSxiueMms97h4IIXAOS5dNwLvtObyao7qzZP.mp3', 174.994),
(136, '2023-04-11 08:54:07', '2023-04-11 08:54:07', 'Sermonette', 'Grant', 'storage/images/songs/6St2jgOJLQIXSebvyE48esFMbXrr5KpvfbB3M9E7.jpg', 'storage/music/HsFHCzkG3MRpygT7PKfleAa6Nljlm6UreBXEpaVr.mp3', 162.403),
(137, '2023-04-11 10:18:49', '2023-04-11 10:18:49', '9 crimes', 'Damien Rice', 'storage/images/songs/ZzfKwe9Kbh0ac1iD9zpsZXEtxezxgRB3AzmhPMVY.jpg', 'storage/music/jRRefRnyyekQASIF8p0ANbc7VBzIoAFSZ6VEulCD.mp3', 220.656),
(138, '2023-04-11 10:19:39', '2023-04-11 10:19:39', 'Can\'t help falling in love with you', 'Elwis', 'storage/images/songs/NzwlR6ECDErbVetfg2JMmac2sYhc2inbzJXMA1hC.jpg', 'storage/music/S23eP77M7jXFUNNTxoIz1Z5Zcjf8d15XJCA0fpnT.mp3', 180.648),
(139, '2023-04-11 10:20:40', '2023-04-11 10:20:40', 'Never enought', 'Loren Allred', 'storage/images/songs/j6s38ocI46WO3OEpFwwGpRX7aighimFv1YOR3v9w.jpg', 'storage/music/SLPiZBKUsHzJKMWWvwTjo70VR9XSJJOPVP4NnUsG.mp3', 208.692),
(140, '2023-04-11 10:21:22', '2023-04-11 10:21:22', 'Right Here Waiting', 'Richard Marx', 'storage/images/songs/AyVfg6lgxW65jkhr9KlsKpNummz45KuL2jK2LTkL.jpg', 'storage/music/PT83Kp2hvigRjvlrNONOgVBKmEyuT9L6t4ndAAbM.mp3', 263.523),
(142, '2023-04-11 10:24:13', '2023-04-11 10:24:13', 'My Heart Will Go On', 'Celine Dion', 'storage/images/songs/6t35Aaw2gFHPbS06FmtvqYNbsIvbggMaKXdpMuXv.jpg', 'storage/music/lIWwsQZvf4MhaoRylAyN7rbHARHdadTDKIIIQp9z.mp3', 280.738),
(143, '2023-04-11 10:24:51', '2023-04-11 10:24:51', 'Unchanted Melody', 'Ballroom', 'storage/images/songs/MTHxNxOAeZzxLkxs3igPBYOs67hiDIWcxTGHHPpo.jpg', 'storage/music/JetY0dssx6wqMP0jSpB25xsduMvoqkUMBnvtscb0.mp3', 131.88),
(146, '2023-04-11 11:18:59', '2023-04-11 11:18:59', 'This is live', 'Amy Macdonald', 'storage/images/songs/iz65UD23tWVxrxGIjeTFUv6pInWwVx3li03B6Bjd.jpg', 'storage/music/MLcpEvdGHXaUAsQo4mh64pro4GZYmoKWH9cCtkI4.mp3', 196.056),
(148, '2023-04-11 11:35:24', '2023-04-11 11:35:24', 'Deamon Kitty Rag', 'Charleston', 'storage/images/songs/t52tYWof1pD0qZE5NsI2BKvzuA5OtqlWX4rzfg8o.jpg', 'storage/music/BwtQ2XPZUwyKQLpm7QrmXSPDCZFoMdvUh7Uvcere.mp3', 240.768),
(149, '2023-04-11 11:37:16', '2023-04-11 11:37:16', 'Bare necessities', 'Dimie Cat', 'storage/images/songs/aCdChA3FwKfzcE7WbLBU6AYLedXzhpRuqooXAUJI.jpg', 'storage/music/YWmAlzBLj0dwgMXqiqM1GYlgkJVMqWFK43Aq0xGO.mp3', 249.13),
(151, '2023-04-11 12:55:45', '2023-04-11 12:55:45', 'Forty Days & Forty Nights', ' The blue Vipers', 'storage/images/songs/CmpZBZcULs6x3FqdgX7A8jEeGtiLK7IWuWSfAHSB.jpg', 'storage/music/SoHBLRlaqFCulFhfJxmankPrtiePZib6f85u0Ubs.mp3', 172.173),
(153, '2023-04-11 12:58:21', '2023-04-11 12:58:21', 'Showtime hustle', 'John Rowcroft', 'storage/images/songs/Z4RrezEbsHpVAF9qYgL8rzSOXKqz2H0QaSCqm9da.jpg', 'storage/music/X71rxReGlCaE2ECUiv2vSQL8j8xtUsNrR5i3j8Es.mp3', 166.848),
(154, '2023-04-11 13:02:01', '2023-04-11 13:02:01', 'That Man', 'Caro Emerald', 'storage/images/songs/uXgBUl1rIJvlLtUhqT46t4VOm9DupT3Vz4ymFlux.jpg', 'storage/music/83g4lwz61sZi1fHIXIsEq2wlhVpAoWTe1nDmYYPh.mp3', 231.184),
(155, '2023-04-11 13:05:53', '2023-04-11 13:05:53', 'You\'re The One That I Want ', 'Grease', 'storage/images/songs/kT0VLEPYiT9aEXdlGqRqNVgzAwoNQsboUQDGOYF0.jpg', 'storage/music/8iKdrLNQjtIaiWgaI7Iac1sqPq2dLSe7ySgor89S.mp3', 170.344),
(156, '2023-04-11 13:09:38', '2023-04-11 13:09:38', 'Sing Sing Sing', 'Benny Goodman', 'storage/images/songs/CyfnIV1uk3Nf5uzuOZLW6W7sO2O8FjAi1QNQS10x.jpg', 'storage/music/b9ZciivoENz3WxD6JGEnPMJ62D7EpB02FH2NXuQA.mp3', 302.864),
(157, '2023-04-11 13:40:09', '2023-04-11 13:40:09', 'Don\'t be cruel', 'Elvis', 'storage/images/songs/o78u5RfCQ2jJa12fbju3Sj0xyuCaPHssnzBxWX4G.jpg', 'storage/music/3KvPpEl2hEQWrqo9Pdrea05k53cHv0ChCPLHtjk3.mp3', 122.958),
(158, '2023-04-11 13:42:50', '2023-04-11 13:42:50', 'Be my guest', 'Fats Domino', 'storage/images/songs/CKovTREbwGexsgDDPmfDziKtDrl4qt53Lql09sJ9.jpg', 'storage/music/KGpUdezQ7xwj5jiJi43ezFmohdbx7ijQSW51Cmph.mp3', 139.624),
(159, '2023-04-11 13:45:56', '2023-04-11 13:45:56', 'Blinding Lights', 'Weeknd', 'storage/images/songs/4kYQfL8t9nRObiQUE2eoOkRwnd905XqLRdygtKf5.jpg', 'storage/music/ZVSLyeY39v0Mm5wbLHe2NvkS2BmxFSuLPaWhHy1J.mp3', 203.807),
(160, '2023-04-11 13:48:33', '2023-04-11 13:48:33', 'Candyman', 'Christina Aguilera', 'storage/images/songs/TUs8UC1Gw2PiJoezfVrRZOQAuS7MQSrfTHtelpDN.jpg', 'storage/music/nP1m9AKSUqUAaBCABW61e6ZDNQDN3UHIo7voXmmP.mp3', 196.571),
(161, '2023-04-11 13:52:46', '2023-04-11 13:52:46', 'Hit The Road Jack', ' Ray Charles', 'storage/images/songs/pXs3qysr4Yolzk4mwHYjb0GJ6VvJuCV0lMaAT6R8.jpg', 'storage/music/DUAnqBMwJ3hiTByx7f0j1p4oQzj7IU8OXybJBwYO.mp3', 118.57),
(162, '2023-04-11 13:56:38', '2023-04-11 13:56:38', 'Hound Dog', 'Elwis', 'storage/images/songs/K7EFHk5NevprQqztxs4UTk2qHmL6ahENJQgljBRW.jpg', 'storage/music/YLYKkSIgi6CbI92ujkceisPinuOSo49BIpMcNnsY.mp3', 134.374),
(163, '2023-04-11 13:58:22', '2023-04-11 13:58:22', 'Hold On Tight', 'ELO', 'storage/images/songs/WHoPEGNQy01byeV3AnleOEExsaxaPKCS5MMFnSBq.jpg', 'storage/music/l9Rs2HhkWGTJ7tuaHRk0eAT7OtmkbzkLibzgIfgf.mp3', 188.447),
(164, '2023-04-11 14:00:28', '2023-04-11 14:00:28', 'Am so Excited', 'Pointer Sisters', 'storage/images/songs/QgN23P6oUwYvKE0VRZBvzSYikJ3OMNz9N74jHtYc.jpg', 'storage/music/6PIPds1nTWg6ly7HXHyMVKraXBU5Zeh3KCZ0QQMK.mp3', 227.808),
(165, '2023-04-11 14:04:36', '2023-04-11 14:04:36', 'Johny Be Good', 'Chuck Berry', 'storage/images/songs/yz6Kh1U2ERlLQJXTbWwepZqhZKBQ7i7Ko5iLWbtS.jpg', 'storage/music/QdrCzyQ43FNd8oDwT1Acprw1SvI2PkYovNJOXYdR.mp3', 160.34),
(167, '2023-04-11 14:19:23', '2023-04-11 14:19:23', 'La Bamba', 'Ritchie Valens', 'storage/images/songs/iFtoICAOe66Xm4RVCiHrWyjkD0S6delgLhD4VTC4.jpg', 'storage/music/HDgtbAMJhyeVVAAawlgnGvsyxDgVI4d3pvES9fyS.mp3', 170.971),
(168, '2023-04-11 14:20:38', '2023-04-11 14:20:38', 'la cuccanella', 'Ballrooom', 'storage/images/songs/cWS3El3wCjvr3xI0LizQ0Ec3tmm6L1n3i9ajjepO.jpg', 'storage/music/2ghjHocMoLtzQXube0q52yrJ9dV6STwmTGwBwCJU.mp3', 181.368),
(169, '2023-04-11 14:24:18', '2023-04-11 14:24:18', 'Let\'s dance', 'Chris Montez', 'storage/images/songs/VaAr8rhO2BAIz23orDUxpxw6ZpqqOwfUGriTdDFe.jpg', 'storage/music/iFqfrqx34oI6c1gvuK3mkERkonvFY0y7klvxJ1Bx.mp3', 145.528),
(171, '2023-04-11 14:27:52', '2023-04-11 14:27:52', 'Rock and Roll is King', 'ELO', 'storage/images/songs/Efz0KlKl3RBEf92O9kxkr5l9YO8FsfmLbxZK2pNK.jpg', 'storage/music/4sMG2zIGBRFEHFruXeaNFLW7AcSRsYMG6DE1euZQ.mp3', 185.616),
(173, '2023-04-11 15:37:39', '2023-04-11 15:37:39', 'Sofia', 'Alvaro Soler', 'storage/images/songs/o9mETAAjPt9kxuU4gZQM98gAr3X9cpa7jJbCWUzv.jpg', 'storage/music/RVg4pfM5e2dpdJSYvfvzKbMZSNiyspvs2Nyt9VwK.mp3', 214.309),
(174, '2023-04-11 15:38:41', '2023-04-11 15:38:41', 'Bongo Cha Cha Cha', 'Caterina Valente', 'storage/images/songs/GisxNAtSeIcdRlYVg7lsf43jLYdXP1Y7SqxdyvUP.jpg', 'storage/music/mGlx9AolxZhAfMav8R6mGhbq6xsAKjds49DS3e9y.mp3', 166.766),
(176, '2023-04-11 15:41:58', '2023-04-11 15:41:58', 'Flowers', 'Miley Cyrus', 'storage/images/songs/aD0AuaGNcnjwWj9AiwqJkUhTBviJr3J4DoBxlpiL.jpg', 'storage/music/xfA7mGOIDXb5prOSydv8b6oc9oCagG5ylI15HoIP.mp3', 202.188),
(177, '2023-04-11 15:42:43', '2023-04-11 15:42:43', 'Francisco Guayabal', 'Ballroom', 'storage/images/songs/3CWngyFVyIpPshOojXFN2X7s5smfRmc7ddYRDugl.jpg', 'storage/music/TZABEjEkkfWnFY3Ci99IoHD9mp1KVHwtmU0Q53dc.mp3', 152.352),
(178, '2023-04-11 15:44:53', '2023-04-11 15:44:53', 'Havana', 'Camila Cabello', 'storage/images/songs/Rf84ztcNscZU12oeNv6W4wqHjhAh4uDHFEVd29c1.jpg', 'storage/music/PZLKba3XZBEOrTNlS3KNx6hjX38KJ1nuXvZHvCNi.mp3', 219.193),
(180, '2023-04-11 15:47:37', '2023-04-11 15:47:37', 'Seniorita', 'Mendes, Cabello', 'storage/images/songs/bf5dgVgSG3FrZXITCncfUvtAzoiV1A6QozdXSvWh.jpg', 'storage/music/Q8A5gpaSCb7u1t7XMNAhGWHlGGypMut44zobm0A6.mp3', 191.608),
(181, '2023-04-11 15:50:42', '2023-04-11 15:50:42', 'Marvin Gaye', 'Charlie Puth ', 'storage/images/songs/ThernyPwunwQ23aHvVMKiboQoaibx8MTCazKF0pc.jpg', 'storage/music/OM9UHFzzeNMHRRnxLFtTZolo3iTnWGthEpnwKQln.mp3', 190.955),
(182, '2023-04-11 16:34:31', '2023-04-11 16:34:31', 'Lay All Your Love On Me', 'Ballroom', 'storage/images/songs/8OF1RKT2wDNXHzhQFZupBvPepNsVwgwKxIYpig4a.jpg', 'storage/music/ObaZHV8J5OQ67JYrPF7vmcsZ8zHysLpDRdXHoJGT.mp3', 121.078),
(183, '2023-04-11 16:44:15', '2023-04-11 16:44:15', 'Espania Cani', 'Ballroom', 'storage/images/songs/Ji7GjvKuOodiAvzKNCSCkW3e1fZmZdaCtbptSn6Q.jpg', 'storage/music/dHC86KVBmvMxRVnezmP087nlYyCxqRtnEgYBrBav.mp3', 134.322),
(184, '2023-04-11 16:46:47', '2023-04-11 16:46:47', 'Malaguana', 'Ballroom', 'storage/images/songs/n7JiK6UbGzTLgO1ZX0h0YbGvGOJeP5r4mgi7Fo6K.jpg', 'storage/music/tcPRtNkw3JkcOwSgTC0BcJ5QzoM0hI8UXRCwIjfp.mp3', 123.089),
(185, '2023-04-11 16:47:22', '2023-04-11 16:47:22', 'Spanish gypsy', 'Ballroom', 'storage/images/songs/pF8FpFS3Z8vkHVSYEJRutq9e67Nd41uOORGfNfEk.jpg', 'storage/music/fdxlVNTHv8ju9Bz7bmaxNeIemzhm2VZ0oN3Ivehq.mp3', 125.257),
(186, '2023-04-11 17:34:29', '2023-04-11 17:34:29', 'Cheri Cheri lady', 'Modern Talking', 'storage/images/songs/elvqC87Xat4u7Kz8rHsO1L5dy0yuDSErsuFNrDLS.png', 'storage/music/qRFUmgwA0oaV06rrPkGYkia4MTx19NxK0o9Zgd9E.mp3', 197.695),
(187, '2023-04-11 17:38:19', '2023-04-11 17:38:19', 'Dance Monkey', 'Tones and I', 'storage/images/songs/bAtnP5fnEe2ZI84v6mYTkar7z7xAW4eBbUtlPrpc.jpg', 'storage/music/p9Ay8kVwznz0nRNdw6mvBDwou0tvgdrcR2UDh9vU.mp3', 209.633),
(188, '2023-04-11 17:39:20', '2023-04-11 17:39:20', 'Down Under', 'Men at Work', 'storage/images/songs/EUyDrFrX1ujRHRK0y8b6j4gPz2htkZPUGuE8KwqT.png', 'storage/music/ibidUcrA8C3kZCEcNnDWI1NcShHjnGUj9PM9KCTt.mp3', 221.362),
(189, '2023-04-11 17:40:26', '2023-04-11 17:40:26', 'Łowcy gwiazd', 'Cleo', 'storage/images/songs/RwVlIRZFJJyvSnxIQnksMw6ogLad3XRszquenVTD.jpg', 'storage/music/Zy6ACkzxoBjWLwQbvIvm9pvSNX6PabUDGK64EDTV.mp3', 205.166),
(190, '2023-04-11 17:42:05', '2023-04-11 17:42:05', 'My Cherie', 'DJ Antoine', 'storage/images/songs/1MU8KuhXc9QUmlrKgc08zmccwl8Ijlkrj8smG0Sg.jpg', 'storage/music/nTrgVAZaV7ju6z79qhWCKP04r0JKBjQLBuA06tFB.mp3', 191.425),
(191, '2023-04-11 17:46:10', '2023-04-11 17:46:10', 'Never Going Home', 'Kungs', 'storage/images/songs/y6xlhfzMnEPxqbO7J6cf9BMqeG1q4J7yALjzLD1B.jpg', 'storage/music/UPL4fJxdDgWP1wQPGlOdekeEObz805G7yLhxCcZH.mp3', 167.314),
(192, '2023-04-11 17:47:25', '2023-04-11 17:47:25', 'One way Ticket', 'Eruption', 'storage/images/songs/AFCR7MF8SLwXTI5XABkjq2MwSbkioFhYPS1IcN08.jpg', 'storage/music/yVE0FJ38FgzzkGYYp8y6mgz02pVQDRwerbmeACNx.mp3', 213.76),
(193, '2023-04-11 17:51:13', '2023-04-11 17:51:13', 'Rivers of Babylon', 'Boney M', 'storage/images/songs/RQwF2NzvJqKxAdwxz4gIfxKP4BNkjyO4MHHHdbAG.jpg', 'storage/music/Efewwq84GBAPI3Ush2OF8AWVf2fYpksroSGfeLBS.mp3', 274.625),
(194, '2023-04-11 17:52:36', '2023-04-11 17:52:36', 'Sugar', 'Robin shulz', 'storage/images/songs/RgiPklqNYHiVLPgwpRyvK6GIXNtolmRyPaegFUCx.jpg', 'storage/music/5cUgvyG1p3xRo7D2ct9VZ5Luz21pkEjBAcBBZA6B.mp3', 222.696),
(195, '2023-04-11 17:54:44', '2023-04-11 17:54:44', 'You\'re Woman', 'Bad boys blue', 'storage/images/songs/BqYtYILwMszmOnLT2Gxt4WWrvd2YFWPRzkuk08Ch.jpg', 'storage/music/YDB0aMpHFcJMuXGh9Fy8790xgBpxHw0adtVkgS8T.mp3', 233.256),
(196, '2023-04-11 18:16:25', '2023-04-11 18:16:25', 'The Only One', 'Sam Smith', 'storage/images/songs/KjTir0xHZK48y4cMWZQBdfBYzlHQz5t9cLXmfzzt.jpg', 'storage/music/76zT0klab5EgjjALN5HB6WffDccV2Bw2QfiDXGeE.mp3', 237.819),
(197, '2023-04-11 18:17:32', '2023-04-11 18:17:32', 'O nich, O tobie', 'Sylwia Grzeszczak', 'storage/images/songs/orI4hMvSJ6MOzqbZok6VaQB2JlDbu9tAcsY9PP7G.jpg', 'storage/music/gMrJ7aCWwH50JCaKUbJ9bjxA5sdGclPegHANGDMd.mp3', 147.879),
(199, '2023-04-11 18:24:17', '2023-04-11 18:24:17', 'Shallow', 'Lady Gaga', 'storage/images/songs/VKtLFr2lVOS5Xu16wPldCjELxxSpldlZepjxiQwW.jpg', 'storage/music/FQOL2n4VQcpW3s4lWAV1RsGRIkwtUkKBOryrAMsu.mp3', 218.514),
(200, '2023-04-11 18:25:13', '2023-04-11 18:25:13', 'Something Stupid', 'Ballroom', 'storage/images/songs/qwbBKMqCs5GPhefkYfczjdrKILZnTZfrWLrRDf1h.jpg', 'storage/music/eqibjObpDp2anXDcJzSZacm8936yKg4MJtKTyHcJ.mp3', 167.079),
(201, '2023-04-11 18:27:03', '2023-04-11 18:27:03', 'Tears in Heaven', 'Clapton', 'storage/images/songs/QUribk0PpsuDTf5ws0VTeQCqhNBDwAzOWtWmYiwi.jpg', 'storage/music/rVdfDPEBv7Gar8080wAjwPy55HRxVCBblGVjmJTj.mp3', 274.896),
(203, '2023-04-12 07:46:07', '2023-04-12 07:46:07', 'La Chica De Cuba', 'Musheev', 'storage/images/songs/9h5B4l0ioKqgPsP5botEtN0pElrjP0s5cWBEl01j.jpg', 'storage/music/9os97W5Ei2g5w4ji5LQvOp8SDZqoWV5YU6tUscbk.mp3', 204.816),
(204, '2023-04-12 07:47:10', '2023-04-12 07:47:10', 'You Contigo, Tu Conmigo', 'Soler', 'storage/images/songs/OreCkAuXzhBWeGLvlLXaOZsrdfqDXuxoH0Y2UqG2.jpg', 'storage/music/oETs7dbYxfYIOotrvkdNYNprQQmIc73K1aPnEtd5.mp3', 179.775),
(205, '2023-04-12 07:47:51', '2023-04-12 07:47:51', 'Cheap Thrills', 'DJ Maksy', 'storage/images/songs/hSH7UNS8MqLdrYESziAd3ZBmQHqQ0jK0fdRz91P6.jpg', 'storage/music/PIv3QZWTCTybLqX5I0hmy9N9XSpHnIJRTDSdUkdk.mp3', 178.776),
(206, '2023-04-12 07:48:20', '2023-04-12 07:48:20', 'Addicted to You', 'Shakira', 'storage/images/songs/M9CH5ONzUxKGGCRNBDwjURMXl5WrEBNEtg9T0ryB.jpg', 'storage/music/xrEDxDDd5RTwYhDIsd5ByNizLC2JcrqvuguxOF0p.mp3', 149.682),
(207, '2023-04-12 07:48:57', '2023-04-12 07:48:57', 'Bailando', 'Enrique Iglesias', 'storage/images/songs/EUhGeVNu65fxA6CG0MTuviXc9L07vuoHlWoOizkE.jpg', 'storage/music/XP9yayf3UGD2ee8k9t5AB8yxODdCM0S2DrSV8joj.mp3', 241.528),
(208, '2023-04-12 07:49:54', '2023-04-12 07:49:54', 'Duele el Corazon', ' Enrique Iglesias', 'storage/images/songs/nPyIQx2RZ4vAO3RGdz1wd7c6gwSyZFmoLJsJZl1x.jpg', 'storage/music/2bK5W4ekHenoF80I6PCgfCQ3i0ozzU3qlFr7pc9k.mp3', 199.34),
(209, '2023-04-12 07:50:27', '2023-04-12 07:50:27', 'Despacito', 'Fonsi', 'storage/images/songs/hSVGHewuPHyA6Ijok6eIlDQpi7HFPsIpAGGSuML2.jpg', 'storage/music/lATTiyjS8Q0fasEUgNJstF5buvcW59z1a9ADntp3.mp3', 240.771),
(210, '2023-04-12 07:50:53', '2023-04-12 07:50:53', 'Mil Pasos', 'Soha', 'storage/images/songs/LnH5AVTBJieov8S7hs135InqNEMVebGcF1VZvo3G.jpg', 'storage/music/016A7pOz9kF4MXkFvp00o6PZlTbxsn6p8QdfAx9m.mp3', 253.022),
(211, '2023-04-12 07:51:36', '2023-04-12 07:51:36', 'Tic Tic Tac', 'Bellini', 'storage/images/songs/CXqTXkqfvQo8NbBYjFU6V0zkDipwkpEjZ48tBRkX.jpg', 'storage/music/vZ219V8GUl58NWb3ye9JEN8AayaInn3eoxaOZMo7.mp3', 188.735),
(212, '2023-04-12 07:55:28', '2023-04-12 07:55:28', '\'T Smidje', 'Laïs', 'storage/images/songs/mHOmlBjjAr6vzKxX8PJ0onBk8rZrmB7jgF5roJ0p.jpg', 'storage/music/ga9WOtRIat9vPRg444nwMq0L84CV6fePpYJhZBa8.mp3', 180.95),
(228, '2023-04-13 07:31:42', '2023-04-13 07:31:42', 'Friend like Me', 'Ballroom', 'storage/images/songs/hav6bdr61z9XhMHBeTPVObFZVpTzWNACnc4Pf9Ix.jpg', 'storage/music/ySItj96SeY97RjY1XDnZsVwsOJJQomSViGfMmDmh.mp3', 139.494),
(229, '2023-04-13 07:32:43', '2023-04-13 07:32:43', 'Nah Neh Nah', 'Ballroom', 'storage/images/songs/92prYj1U7K5Blc38s6wX0LFbsl8mjy1JBJU6WF7U.jpg', 'storage/music/BODAMqFT2lyrRo6fCoXHgIGbpoNDdPj2ysTLUVEX.mp3', 186.648),
(230, '2023-04-13 07:33:35', '2023-04-13 07:33:35', 'Zawsze tam gdzie ty', 'Lady Pank', 'storage/images/songs/0J5WaFi2bFpTCazVNhGZgOksRAPQG6yg3bq1nt7F.jpg', 'storage/music/OdZd5b0uz1vNSR3HlITf1iJDBCKVMPHqlgudAtMP.mp3', 259.291),
(231, '2023-04-21 10:30:34', '2023-04-21 10:30:34', 'Sixteen tons', 'Ballroom', 'storage/images/songs/dQhmOm3Ci1uHpKT70qyYaAD9q26fqMy872djP3SM.jpg', 'storage/music/zqtMBKXZJbGbdNbgO3BGo37dZlzpd7oVte3LwYCK.mp3', 136.464),
(232, '2023-04-21 10:43:37', '2023-04-21 10:43:37', 'Crazy in Love', 'Kid Koala', 'storage/images/songs/7KPvR6khOprXLT7CifwPShnzVsZrS3WXakAGivYx.jpg', 'storage/music/phYkKuglSCu1Zxh4jXDMX0ZmymMpdf7avXrdWGIr.mp3', 188.604),
(244, '2023-06-02 06:07:27', '2023-06-02 06:07:27', ' Runaround Sue', 'Dion', 'storage/images/songs/2viKAVEYQBJVVJOBgkhJ6hxHWimRnm4ykayv8NMC.jpg', 'storage/music/NNSAflxTvIjDrQuKCOcHPTMIbgyVfLmC4bjQldfj.mp3', 172),
(245, '2023-06-02 06:12:34', '2023-06-02 06:12:34', 'Let\'s Twist Again', 'Chubby Checker', 'storage/images/songs/qpnsyjB6Foz0eLKkQiQ0X9QEd6TW3sRPt2LXIxrw.jpg', 'storage/music/PQuI3n8vPhETTwK9tn88GhUccSjI4WS0ZP8HxTw8.mp3', 147),
(246, '2023-06-02 06:16:55', '2023-06-02 06:16:55', 'Lambada', 'Kaoma', 'storage/images/songs/2A7G4rCJW2UaTrP6f2QZcL9xcDVumiUNtAp5IEtH.jpg', 'storage/music/Tv3VROByxJhDmJ99TwjyYlxS0EISPvkjih1tGl30.mp3', 202.2),
(250, '2023-06-02 06:28:06', '2023-06-02 06:28:06', 'I Am Believer', 'Smash Mouth', 'storage/images/songs/2s83Wmrd9d58pp1QLGPgwTHYWO8XRzeW7Fz3Vivw.jpg', 'storage/music/QkzNVdTvu2dfswvSUFPi5VeTELOG01JRVcnuQXAh.mp3', 185);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `song_tag`
--

CREATE TABLE `song_tag` (
  `id` bigint UNSIGNED NOT NULL,
  `song_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `song_tag`
--

INSERT INTO `song_tag` (`id`, `song_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(2, 47, 1, NULL, NULL),
(6, 50, 1, NULL, NULL),
(10, 48, 1, NULL, NULL),
(11, 49, 1, NULL, NULL),
(32, 48, 25, '2023-04-09 21:02:54', '2023-04-09 21:02:54'),
(45, 50, 25, '2023-04-10 08:04:24', '2023-04-10 08:04:24'),
(63, 115, 1, '2023-04-10 12:14:01', '2023-04-10 12:14:01'),
(64, 115, 24, '2023-04-10 12:14:10', '2023-04-10 12:14:10'),
(65, 116, 1, '2023-04-10 12:14:51', '2023-04-10 12:14:51'),
(67, 118, 1, '2023-04-10 12:16:43', '2023-04-10 12:16:43'),
(69, 120, 1, '2023-04-10 12:18:28', '2023-04-10 12:18:28'),
(70, 116, 24, '2023-04-10 12:19:03', '2023-04-10 12:19:03'),
(72, 118, 24, '2023-04-10 12:19:08', '2023-04-10 12:19:08'),
(74, 120, 24, '2023-04-10 12:19:12', '2023-04-10 12:19:12'),
(78, 124, 1, '2023-04-10 12:55:56', '2023-04-10 12:55:56'),
(79, 125, 1, '2023-04-10 12:57:13', '2023-04-10 12:57:13'),
(80, 126, 1, '2023-04-10 12:58:13', '2023-04-10 12:58:13'),
(81, 127, 1, '2023-04-10 13:02:00', '2023-04-10 13:02:00'),
(82, 128, 1, '2023-04-10 13:04:23', '2023-04-10 13:04:23'),
(83, 129, 1, '2023-04-10 13:08:01', '2023-04-10 13:08:01'),
(84, 130, 1, '2023-04-10 13:08:31', '2023-04-10 13:08:31'),
(85, 124, 27, '2023-04-10 13:08:39', '2023-04-10 13:08:39'),
(87, 126, 27, '2023-04-10 13:08:43', '2023-04-10 13:08:43'),
(88, 127, 27, '2023-04-10 13:08:44', '2023-04-10 13:08:44'),
(89, 128, 27, '2023-04-10 13:08:46', '2023-04-10 13:08:46'),
(90, 129, 27, '2023-04-10 13:08:48', '2023-04-10 13:08:48'),
(91, 130, 27, '2023-04-10 13:08:50', '2023-04-10 13:08:50'),
(92, 131, 1, '2023-04-11 06:27:43', '2023-04-11 06:27:43'),
(93, 132, 1, '2023-04-11 06:28:34', '2023-04-11 06:28:34'),
(94, 133, 1, '2023-04-11 06:29:38', '2023-04-11 06:29:38'),
(95, 134, 1, '2023-04-11 08:52:13', '2023-04-11 08:52:13'),
(96, 135, 1, '2023-04-11 08:53:31', '2023-04-11 08:53:31'),
(97, 136, 1, '2023-04-11 08:54:07', '2023-04-11 08:54:07'),
(98, 131, 28, '2023-04-11 08:55:33', '2023-04-11 08:55:33'),
(99, 132, 28, '2023-04-11 08:55:35', '2023-04-11 08:55:35'),
(100, 133, 28, '2023-04-11 08:55:38', '2023-04-11 08:55:38'),
(101, 134, 28, '2023-04-11 08:55:39', '2023-04-11 08:55:39'),
(102, 135, 28, '2023-04-11 08:55:44', '2023-04-11 08:55:44'),
(103, 136, 28, '2023-04-11 08:55:46', '2023-04-11 08:55:46'),
(104, 137, 1, '2023-04-11 10:18:49', '2023-04-11 10:18:49'),
(105, 138, 1, '2023-04-11 10:19:39', '2023-04-11 10:19:39'),
(106, 139, 1, '2023-04-11 10:20:40', '2023-04-11 10:20:40'),
(107, 140, 1, '2023-04-11 10:21:22', '2023-04-11 10:21:22'),
(109, 142, 1, '2023-04-11 10:24:13', '2023-04-11 10:24:13'),
(110, 143, 1, '2023-04-11 10:24:51', '2023-04-11 10:24:51'),
(112, 137, 29, '2023-04-11 10:26:05', '2023-04-11 10:26:05'),
(114, 139, 29, '2023-04-11 10:26:10', '2023-04-11 10:26:10'),
(115, 140, 29, '2023-04-11 10:26:12', '2023-04-11 10:26:12'),
(116, 142, 29, '2023-04-11 10:26:13', '2023-04-11 10:26:13'),
(117, 143, 29, '2023-04-11 10:26:16', '2023-04-11 10:26:16'),
(119, 49, 29, '2023-04-11 10:26:46', '2023-04-11 10:26:46'),
(121, 146, 1, '2023-04-11 11:18:59', '2023-04-11 11:18:59'),
(123, 148, 1, '2023-04-11 11:35:24', '2023-04-11 11:35:24'),
(124, 149, 1, '2023-04-11 11:37:16', '2023-04-11 11:37:16'),
(126, 151, 1, '2023-04-11 12:55:45', '2023-04-11 12:55:45'),
(128, 153, 1, '2023-04-11 12:58:21', '2023-04-11 12:58:21'),
(129, 154, 1, '2023-04-11 13:02:01', '2023-04-11 13:02:01'),
(130, 155, 1, '2023-04-11 13:05:53', '2023-04-11 13:05:53'),
(132, 146, 30, '2023-04-11 13:08:04', '2023-04-11 13:08:04'),
(134, 148, 30, '2023-04-11 13:08:08', '2023-04-11 13:08:08'),
(135, 149, 30, '2023-04-11 13:08:11', '2023-04-11 13:08:11'),
(136, 151, 30, '2023-04-11 13:08:14', '2023-04-11 13:08:14'),
(138, 153, 30, '2023-04-11 13:08:18', '2023-04-11 13:08:18'),
(139, 154, 30, '2023-04-11 13:08:21', '2023-04-11 13:08:21'),
(140, 155, 30, '2023-04-11 13:08:23', '2023-04-11 13:08:23'),
(141, 156, 1, '2023-04-11 13:09:38', '2023-04-11 13:09:38'),
(142, 156, 30, '2023-04-11 13:10:06', '2023-04-11 13:10:06'),
(143, 157, 1, '2023-04-11 13:40:09', '2023-04-11 13:40:09'),
(144, 158, 1, '2023-04-11 13:42:50', '2023-04-11 13:42:50'),
(145, 159, 1, '2023-04-11 13:45:56', '2023-04-11 13:45:56'),
(146, 160, 1, '2023-04-11 13:48:33', '2023-04-11 13:48:33'),
(147, 161, 1, '2023-04-11 13:52:46', '2023-04-11 13:52:46'),
(148, 162, 1, '2023-04-11 13:56:38', '2023-04-11 13:56:38'),
(149, 163, 1, '2023-04-11 13:58:22', '2023-04-11 13:58:22'),
(150, 164, 1, '2023-04-11 14:00:28', '2023-04-11 14:00:28'),
(151, 165, 1, '2023-04-11 14:04:36', '2023-04-11 14:04:36'),
(153, 167, 1, '2023-04-11 14:19:23', '2023-04-11 14:19:23'),
(154, 168, 1, '2023-04-11 14:20:38', '2023-04-11 14:20:38'),
(155, 169, 1, '2023-04-11 14:24:18', '2023-04-11 14:24:18'),
(157, 171, 1, '2023-04-11 14:27:52', '2023-04-11 14:27:52'),
(159, 157, 25, '2023-04-11 14:41:28', '2023-04-11 14:41:28'),
(160, 158, 25, '2023-04-11 14:41:31', '2023-04-11 14:41:31'),
(161, 159, 25, '2023-04-11 14:41:33', '2023-04-11 14:41:33'),
(163, 161, 25, '2023-04-11 14:41:38', '2023-04-11 14:41:38'),
(164, 162, 25, '2023-04-11 14:41:40', '2023-04-11 14:41:40'),
(165, 163, 25, '2023-04-11 14:41:44', '2023-04-11 14:41:44'),
(166, 164, 25, '2023-04-11 14:41:46', '2023-04-11 14:41:46'),
(167, 165, 25, '2023-04-11 14:41:49', '2023-04-11 14:41:49'),
(168, 167, 25, '2023-04-11 14:41:52', '2023-04-11 14:41:52'),
(169, 168, 25, '2023-04-11 14:41:54', '2023-04-11 14:41:54'),
(170, 169, 25, '2023-04-11 14:41:57', '2023-04-11 14:41:57'),
(172, 171, 25, '2023-04-11 14:42:00', '2023-04-11 14:42:00'),
(174, 173, 1, '2023-04-11 15:37:39', '2023-04-11 15:37:39'),
(175, 174, 1, '2023-04-11 15:38:41', '2023-04-11 15:38:41'),
(177, 176, 1, '2023-04-11 15:41:58', '2023-04-11 15:41:58'),
(178, 177, 1, '2023-04-11 15:42:43', '2023-04-11 15:42:43'),
(179, 178, 1, '2023-04-11 15:44:53', '2023-04-11 15:44:53'),
(181, 180, 1, '2023-04-11 15:47:37', '2023-04-11 15:47:37'),
(182, 181, 1, '2023-04-11 15:50:42', '2023-04-11 15:50:42'),
(183, 173, 31, '2023-04-11 15:50:48', '2023-04-11 15:50:48'),
(184, 174, 31, '2023-04-11 15:50:51', '2023-04-11 15:50:51'),
(186, 176, 31, '2023-04-11 15:50:55', '2023-04-11 15:50:55'),
(187, 177, 31, '2023-04-11 15:50:57', '2023-04-11 15:50:57'),
(188, 178, 31, '2023-04-11 15:50:59', '2023-04-11 15:50:59'),
(189, 180, 31, '2023-04-11 15:51:01', '2023-04-11 15:51:01'),
(190, 181, 31, '2023-04-11 15:51:03', '2023-04-11 15:51:03'),
(191, 182, 1, '2023-04-11 16:34:31', '2023-04-11 16:34:31'),
(192, 183, 1, '2023-04-11 16:44:15', '2023-04-11 16:44:15'),
(193, 184, 1, '2023-04-11 16:46:47', '2023-04-11 16:46:47'),
(194, 185, 1, '2023-04-11 16:47:22', '2023-04-11 16:47:22'),
(195, 185, 32, '2023-04-11 16:54:51', '2023-04-11 16:54:51'),
(196, 184, 32, '2023-04-11 16:54:54', '2023-04-11 16:54:54'),
(197, 183, 32, '2023-04-11 16:54:56', '2023-04-11 16:54:56'),
(198, 182, 32, '2023-04-11 16:54:59', '2023-04-11 16:54:59'),
(199, 186, 1, '2023-04-11 17:34:29', '2023-04-11 17:34:29'),
(200, 187, 1, '2023-04-11 17:38:19', '2023-04-11 17:38:19'),
(201, 188, 1, '2023-04-11 17:39:20', '2023-04-11 17:39:20'),
(202, 189, 1, '2023-04-11 17:40:26', '2023-04-11 17:40:26'),
(203, 190, 1, '2023-04-11 17:42:05', '2023-04-11 17:42:05'),
(204, 191, 1, '2023-04-11 17:46:10', '2023-04-11 17:46:10'),
(205, 192, 1, '2023-04-11 17:47:25', '2023-04-11 17:47:25'),
(206, 193, 1, '2023-04-11 17:51:13', '2023-04-11 17:51:13'),
(207, 194, 1, '2023-04-11 17:52:36', '2023-04-11 17:52:36'),
(208, 195, 1, '2023-04-11 17:54:44', '2023-04-11 17:54:44'),
(209, 186, 35, '2023-04-11 17:55:18', '2023-04-11 17:55:18'),
(210, 187, 35, '2023-04-11 17:55:19', '2023-04-11 17:55:19'),
(211, 188, 35, '2023-04-11 17:55:21', '2023-04-11 17:55:21'),
(212, 189, 35, '2023-04-11 17:55:23', '2023-04-11 17:55:23'),
(213, 190, 35, '2023-04-11 17:55:25', '2023-04-11 17:55:25'),
(214, 191, 35, '2023-04-11 17:55:27', '2023-04-11 17:55:27'),
(215, 192, 35, '2023-04-11 17:55:29', '2023-04-11 17:55:29'),
(216, 194, 35, '2023-04-11 17:55:32', '2023-04-11 17:55:32'),
(217, 193, 35, '2023-04-11 17:55:33', '2023-04-11 17:55:33'),
(218, 195, 35, '2023-04-11 17:55:36', '2023-04-11 17:55:36'),
(219, 196, 1, '2023-04-11 18:16:25', '2023-04-11 18:16:25'),
(220, 197, 1, '2023-04-11 18:17:32', '2023-04-11 18:17:32'),
(222, 199, 1, '2023-04-11 18:24:17', '2023-04-11 18:24:17'),
(223, 200, 1, '2023-04-11 18:25:13', '2023-04-11 18:25:13'),
(224, 201, 1, '2023-04-11 18:27:03', '2023-04-11 18:27:03'),
(227, 201, 33, '2023-04-11 18:29:35', '2023-04-11 18:29:35'),
(228, 200, 33, '2023-04-11 18:29:37', '2023-04-11 18:29:37'),
(229, 199, 33, '2023-04-11 18:29:40', '2023-04-11 18:29:40'),
(230, 197, 33, '2023-04-11 18:29:42', '2023-04-11 18:29:42'),
(232, 196, 33, '2023-04-11 18:29:47', '2023-04-11 18:29:47'),
(233, 203, 1, '2023-04-12 07:46:07', '2023-04-12 07:46:07'),
(234, 204, 1, '2023-04-12 07:47:10', '2023-04-12 07:47:10'),
(235, 205, 1, '2023-04-12 07:47:51', '2023-04-12 07:47:51'),
(236, 206, 1, '2023-04-12 07:48:20', '2023-04-12 07:48:20'),
(237, 207, 1, '2023-04-12 07:48:57', '2023-04-12 07:48:57'),
(238, 208, 1, '2023-04-12 07:49:54', '2023-04-12 07:49:54'),
(239, 209, 1, '2023-04-12 07:50:27', '2023-04-12 07:50:27'),
(240, 210, 1, '2023-04-12 07:50:53', '2023-04-12 07:50:53'),
(241, 211, 1, '2023-04-12 07:51:36', '2023-04-12 07:51:36'),
(242, 203, 34, '2023-04-12 07:51:44', '2023-04-12 07:51:44'),
(243, 204, 34, '2023-04-12 07:51:47', '2023-04-12 07:51:47'),
(244, 205, 34, '2023-04-12 07:51:49', '2023-04-12 07:51:49'),
(245, 206, 34, '2023-04-12 07:51:51', '2023-04-12 07:51:51'),
(246, 207, 34, '2023-04-12 07:51:54', '2023-04-12 07:51:54'),
(247, 208, 34, '2023-04-12 07:51:56', '2023-04-12 07:51:56'),
(248, 209, 34, '2023-04-12 07:51:58', '2023-04-12 07:51:58'),
(249, 210, 34, '2023-04-12 07:52:05', '2023-04-12 07:52:05'),
(250, 211, 34, '2023-04-12 07:52:07', '2023-04-12 07:52:07'),
(251, 212, 1, '2023-04-12 07:55:28', '2023-04-12 07:55:28'),
(271, 228, 1, '2023-04-13 07:31:42', '2023-04-13 07:31:42'),
(272, 229, 1, '2023-04-13 07:32:43', '2023-04-13 07:32:43'),
(273, 230, 1, '2023-04-13 07:33:35', '2023-04-13 07:33:35'),
(274, 228, 30, '2023-04-13 07:34:29', '2023-04-13 07:34:29'),
(275, 229, 30, '2023-04-13 07:34:47', '2023-04-13 07:34:47'),
(276, 230, 33, '2023-04-13 07:34:57', '2023-04-13 07:34:57'),
(287, 212, 38, '2023-04-13 08:45:46', '2023-04-13 08:45:46'),
(294, 231, 1, '2023-04-21 10:30:34', '2023-04-21 10:30:34'),
(295, 231, 28, '2023-04-21 10:30:48', '2023-04-21 10:30:48'),
(296, 232, 1, '2023-04-21 10:43:37', '2023-04-21 10:43:37'),
(297, 232, 30, '2023-04-21 12:39:43', '2023-04-21 12:39:43'),
(313, 160, 25, '2023-06-01 09:10:28', '2023-06-01 09:10:28'),
(316, 244, 1, '2023-06-02 06:07:27', '2023-06-02 06:07:27'),
(317, 244, 25, '2023-06-02 06:08:27', '2023-06-02 06:08:27'),
(318, 245, 1, '2023-06-02 06:12:34', '2023-06-02 06:12:34'),
(319, 245, 42, '2023-06-02 06:13:45', '2023-06-02 06:13:45'),
(320, 246, 1, '2023-06-02 06:16:55', '2023-06-02 06:16:55'),
(321, 246, 42, '2023-06-02 06:17:03', '2023-06-02 06:17:03'),
(325, 250, 1, '2023-06-02 06:28:06', '2023-06-02 06:28:06'),
(326, 250, 25, '2023-06-02 06:39:01', '2023-06-02 06:39:01');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tag`
--

CREATE TABLE `tag` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `tag`
--

INSERT INTO `tag` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '-', NULL, NULL),
(24, 'TANGO', '2023-04-09 16:37:40', '2023-04-09 16:37:40'),
(25, 'JIVE', '2023-04-09 17:35:24', '2023-04-09 17:35:24'),
(27, 'WIEDEńSKI', '2023-04-10 12:39:37', '2023-04-10 12:39:37'),
(28, 'FOXTROT', '2023-04-11 06:27:04', '2023-04-11 06:27:04'),
(29, 'ANGIELSKI', '2023-04-11 08:57:43', '2023-04-11 08:57:43'),
(30, 'QUICKSTEP', '2023-04-11 10:31:30', '2023-04-11 10:31:30'),
(31, 'CHA CHA', '2023-04-11 14:43:44', '2023-04-11 14:43:44'),
(32, 'PASA DOBLE', '2023-04-11 16:44:25', '2023-04-11 16:44:25'),
(33, 'RUMBA', '2023-04-11 16:44:35', '2023-04-11 16:44:35'),
(34, 'SAMBA', '2023-04-11 16:44:39', '2023-04-11 16:44:39'),
(35, 'DISCO', '2023-04-11 16:44:44', '2023-04-11 16:44:44'),
(38, 'BELGIJKA', '2023-04-13 08:15:25', '2023-04-13 08:15:25'),
(42, 'SPECJALNE', '2023-06-02 06:13:27', '2023-06-02 06:13:27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tag_template`
--

CREATE TABLE `tag_template` (
  `id` bigint UNSIGNED NOT NULL,
  `template_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `tag_template`
--

INSERT INTO `tag_template` (`id`, `template_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(56, 43, 35, '2023-06-01 14:02:36', '2023-06-01 14:02:36'),
(57, 43, 29, '2023-06-01 14:02:47', '2023-06-01 14:02:47'),
(58, 43, 24, '2023-06-01 14:02:54', '2023-06-01 14:02:54'),
(59, 43, 27, '2023-06-01 14:03:00', '2023-06-01 14:03:00'),
(60, 43, 28, '2023-06-01 14:03:08', '2023-06-01 14:03:08'),
(61, 43, 30, '2023-06-01 14:03:24', '2023-06-01 14:03:24'),
(62, 43, 34, '2023-06-01 14:03:33', '2023-06-01 14:03:33'),
(63, 43, 31, '2023-06-01 14:03:39', '2023-06-01 14:03:39'),
(64, 43, 33, '2023-06-01 14:03:40', '2023-06-01 14:03:40'),
(65, 43, 32, '2023-06-01 14:03:45', '2023-06-01 14:03:45'),
(66, 43, 25, '2023-06-01 14:03:49', '2023-06-01 14:03:49'),
(68, 44, 24, '2023-06-01 19:26:06', '2023-06-01 19:26:06'),
(69, 44, 25, '2023-06-01 19:26:08', '2023-06-01 19:26:08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `template`
--

CREATE TABLE `template` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loop` tinyint(1) NOT NULL,
  `max_time` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `template`
--

INSERT INTO `template` (`id`, `name`, `loop`, `max_time`, `created_at`, `updated_at`) VALUES
(43, 'wprawki', 1, 120, '2023-06-01 14:02:33', '2023-06-01 14:02:33'),
(44, 'sdsds', 0, 12, '2023-06-01 19:19:41', '2023-06-01 19:36:57'),
(45, 'fdfd', 1, 11, '2023-06-01 19:36:45', '2023-06-01 19:37:03');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeksy dla tabeli `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeksy dla tabeli `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `playlist_name_unique` (`name`);

--
-- Indeksy dla tabeli `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playlist_songs_song_id_foreign` (`song_id`),
  ADD KEY `playlist_songs_playlist_id_foreign` (`playlist_id`);

--
-- Indeksy dla tabeli `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `song_tag`
--
ALTER TABLE `song_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `song_tag_song_id_foreign` (`song_id`),
  ADD KEY `song_tag_tag_id_foreign` (`tag_id`);

--
-- Indeksy dla tabeli `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `tag_template`
--
ALTER TABLE `tag_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `track_template_pivot_track_id_foreign` (`template_id`),
  ADD KEY `track_template_pivot_tag_id_foreign` (`tag_id`);

--
-- Indeksy dla tabeli `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT dla tabeli `playlist_song`
--
ALTER TABLE `playlist_song`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT dla tabeli `song`
--
ALTER TABLE `song`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT dla tabeli `song_tag`
--
ALTER TABLE `song_tag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=327;

--
-- AUTO_INCREMENT dla tabeli `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT dla tabeli `tag_template`
--
ALTER TABLE `tag_template`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT dla tabeli `template`
--
ALTER TABLE `template`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `playlist_song`
--
ALTER TABLE `playlist_song`
  ADD CONSTRAINT `playlist_songs_playlist_id_foreign` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_songs_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `song_tag`
--
ALTER TABLE `song_tag`
  ADD CONSTRAINT `song_tag_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `song` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `song_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `tag_template`
--
ALTER TABLE `tag_template`
  ADD CONSTRAINT `track_template_pivot_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `track_template_pivot_track_id_foreign` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
