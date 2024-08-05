-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 09:07 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass`) VALUES
(1, 'admin@gmail.com', '$2y$10$9S6aLkHj9xmFJQeoS12DJOzpVwIyEwa05lPu0V/Cz8KcApdkqa.BK');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `image` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `url`, `description`, `status`, `image`, `created_at`) VALUES
(2, 'Electronics', 'electronics', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!', 0, NULL, '2024-08-04 14:49:07'),
(3, 'Clithing', 'clithing', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!', 0, NULL, '2024-08-04 14:50:10'),
(4, 'Clthing', 'clthing', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!', 0, NULL, '2024-08-04 14:51:51'),
(5, 'Shirtssss', 'shirtssss', 'new', 0, 'randd1.jpg', '2024-08-04 14:52:52'),
(6, 'Black Men T Shirtshjhjhjhj', 'black-men-t-shirtshjhjhjhj', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!', 0, NULL, '2024-08-04 15:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `cart_details` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `cart_details`, `total_amount`, `shipping_address`, `billing_address`, `status`, `created_at`, `updated_at`, `user_id`, `payment_status`, `transaction_id`) VALUES
(1, 'EIN67701', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', 'Array', 'Array', 'order confirmed', '2024-07-17 18:20:58', '2024-07-19 18:28:26', 8, '0', NULL),
(2, 'EIN83432', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:21:55', '2024-07-18 02:28:52', 0, '0', NULL),
(3, 'EIN69353', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:23:12', '2024-07-18 02:28:52', 0, '0', NULL),
(4, 'EIN79354', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:23:49', '2024-07-18 02:28:52', 0, '0', NULL),
(5, 'EIN73585', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:24:49', '2024-07-18 02:28:52', 0, '0', NULL),
(6, 'EIN41736', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:25:19', '2024-07-18 02:28:52', 0, '0', NULL),
(7, 'EIN16807', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:27:06', '2024-07-18 02:28:52', 0, '0', NULL),
(8, 'EIN93578', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:28:32', '2024-07-18 02:28:52', 0, '0', NULL),
(9, 'EIN66689', '{\"S-Black\":{\"cartkey\":\"S-Black\",\"price\":\"200\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"S\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba5e391.webp\",\"productid\":\"10\",\"qty\":1}}', '200.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-17 18:29:04', '2024-07-18 02:28:52', 0, '0', NULL),
(10, 'EIN933210', '{\"M-Black\":{\"cartkey\":\"M-Black\",\"price\":\"300\",\"title\":\"Black Men T Shirts\",\"attributes\":{\"Size\":[\"M\"],\"Color\":[\"Black\"]},\"img\":\"variations\\/668762ba65264.webp\",\"productid\":\"10\",\"qty\":1}}', '300.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-18 02:10:15', '2024-07-18 02:28:52', 0, '0', NULL),
(11, 'EIN256011', '{\"Maroon-M\":{\"cartkey\":\"Maroon-M\",\"price\":\"10\",\"title\":\"Maroon Men T Shirts\",\"attributes\":{\"Color\":[\"Maroon\"],\"Size\":[\"M\"]},\"img\":\"variations\\/668bd4ab879f4.webp\",\"productid\":\"11\",\"qty\":1}}', '10.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-18 02:24:36', '2024-07-18 02:28:52', 0, '0', NULL),
(12, 'EIN407912', '{\"Maroon-M\":{\"cartkey\":\"Maroon-M\",\"price\":\"10\",\"title\":\"Maroon Men T Shirts\",\"attributes\":{\"Color\":[\"Maroon\"],\"Size\":[\"M\"]},\"img\":\"variations\\/668bd4ab879f4.webp\",\"productid\":\"11\",\"qty\":1}}', '10.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-18 02:28:26', '2024-07-18 02:28:52', 0, '0', NULL),
(13, 'EIN973713', '{\"Maroon-M\":{\"cartkey\":\"Maroon-M\",\"price\":\"10\",\"title\":\"Maroon Men T Shirts\",\"attributes\":{\"Color\":[\"Maroon\"],\"Size\":[\"M\"]},\"img\":\"variations\\/668bd4ab879f4.webp\",\"productid\":\"11\",\"qty\":1}}', '10.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-18 02:32:38', '2024-07-18 02:33:03', 0, '0', NULL),
(14, 'EIN401414', '{\"Maroon-L\":{\"cartkey\":\"Maroon-L\",\"price\":\"10\",\"title\":\"Maroon Men T Shirts\",\"attributes\":{\"Color\":[\"Maroon\"],\"Size\":[\"L\"]},\"img\":\"variations\\/668bd4ab884bc.webp\",\"productid\":\"11\",\"qty\":1}}', '10.00', '{\"billingFirstName\":\"Shivam\",\"billingLastName\":\"Verma\",\"billingPhone\":\"6395741369\",\"billingEmail\":\"sv708128@gmail.com\",\"billingAddress\":\"12 C Mall Road\",\"billingCity\":\"Kanpur\",\"billingState\":\"Uttar Pradesh\",\"billingZip\":\"909011\",\"billingCountry\":\"India\"}', '{\"shippingFirstName\":\"Shivam\",\"shippingLastName\":\"Verma\",\"shippingPhone\":\"6395741369\",\"shippingEmail\":\"sv708128@gmail.com\",\"shippingAddress\":\"12 C Mall Road\",\"shippingCity\":\"Kanpur\",\"shippingState\":\"Uttar Pradesh\",\"shippingZip\":\"909011\",\"shippingCountry\":\"India\"}', 'order confirmed', '2024-07-18 02:34:51', '2024-07-18 02:35:15', 0, 'PAYMENT_SUCCESS', 'MT7850590068188104');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `reg_price` int(11) DEFAULT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `gallery` longtext DEFAULT NULL,
  `category` text DEFAULT NULL,
  `attributes` text DEFAULT NULL,
  `variations` longtext DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `reg_price`, `sale_price`, `qty`, `description`, `long_description`, `image`, `gallery`, `category`, `attributes`, `variations`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Black Men T Shirts', 60, 40, NULL, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores vel sit quidem. Iste reiciendis at, reprehenderit accusantium nobis, culpa pariatur cupiditate a ex aliquam nisi harum? Ex laudantium quos exercitationem!', 'uploads/b1.webp', '[\"uploads\\/m2.webp\",\"uploads\\/m1.webp\",\"uploads\\/b4.webp\",\"uploads\\/b2.webp\"]', 'Men, Black', '{\"Size\":[\"S\",\"M\"],\"Color\":[\"Maroon\",\"Black\"]}', '[{\"price\":\"200\",\"img\":\"variations\\/668762ba5d79d.webp\",\"gallery\":[\"variations\\/668762ba5dc16.webp\",\"variations\\/668762ba5e04e.webp\"],\"qty\":\"10\",\"Size\":\"S\",\"Color\":\"Maroon\"},{\"price\":\"200\",\"img\":\"variations\\/668762ba5e391.webp\",\"gallery\":[\"variations\\/668762ba5e71d.webp\",\"variations\\/668762ba5ea73.webp\"],\"qty\":\"10\",\"Size\":\"S\",\"Color\":\"Black\"},{\"price\":\"300\",\"img\":\"variations\\/668762ba6463a.webp\",\"gallery\":[\"variations\\/668762ba64be5.webp\"],\"qty\":\"10\",\"Size\":\"M\",\"Color\":\"Maroon\"},{\"price\":\"300\",\"img\":\"variations\\/668762ba65264.webp\",\"gallery\":[\"variations\\/668762ba65828.webp\"],\"qty\":\"10\",\"Size\":\"M\",\"Color\":\"Black\"}]', 0, '2024-07-05 03:04:26', '2024-07-05 03:34:25'),
(11, 'Maroon Men T Shirts', 60, 40, NULL, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores vel sit quidem. Iste reiciendis at, reprehenderit accusantium nobis, culpa pariatur cupiditate a ex aliquam nisi harum? Ex laudantium quos exercitationem!', 'uploads/pop1.webp', '[\"uploads\\/popw.webp\"]', 'Men, Black', '{\"Color\":[\"Maroon\"],\"Size\":[\"M\",\"L\"]}', '[{\"price\":\"10\",\"img\":\"variations\\/668bd4ab879f4.webp\",\"gallery\":[\"variations\\/668bd4ab87fa4.webp\"],\"qty\":\"10\",\"Color\":\"Maroon\",\"Size\":\"M\"},{\"price\":\"10\",\"img\":\"variations\\/668bd4ab884bc.webp\",\"gallery\":[\"variations\\/668bd4ab88931.webp\"],\"qty\":\"10\",\"Color\":\"Maroon\",\"Size\":\"L\"}]', 1, '2024-07-08 11:59:39', '2024-07-08 12:01:17'),
(14, 'Black Men T Shirts', 60, 40, NULL, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores vel sit quidem. Iste reiciendis at, reprehenderit accusantium nobis, culpa pariatur cupiditate a ex aliquam nisi harum? Ex laudantium quos exercitationem!', '', '[\"..\\/..\\/uploads\\/Shrugs.jpg\"]', 'Men, Black', '{\"Size\":[\"S\",\"L\"],\"Color\":[\"Black\"]}', '[{\"price\":\"10\",\"img\":\"img_0\",\"gallery\":[],\"qty\":\"10\",\"Size\":\"S\",\"Color\":\"Black\"},{\"price\":\"10\",\"img\":\"img_1\",\"gallery\":[],\"qty\":\"10\",\"Size\":\"L\",\"Color\":\"Black\"}]', 0, '2024-08-04 12:08:31', '2024-08-04 12:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `message` text NOT NULL,
  `stars` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(2) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `userid`, `productid`, `message`, `stars`, `subject`, `created_at`, `updated_at`, `status`) VALUES
(8, 'Shivam', 8, 10, 'Shivam', 1, 'Test', '2024-07-30 02:01:33', '2024-07-30 02:01:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `passwords`, `created_at`, `update_at`) VALUES
(8, 'SHivam', 'sv708128@gmail.com', '$2y$10$15KVbggrQlPWt99KjsAjeuVo3MU8trU56Y1I2GsIJ4UQJ/t4pr03q', '2024-07-18 17:40:00', '2024-07-18 17:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `productdetails` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `productid`, `userid`, `productdetails`, `created_at`, `updated_at`) VALUES
(17, 10, 8, NULL, '2024-07-30 01:59:56', '2024-07-30 01:59:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
