-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.4:3306
-- Час створення: Лют 20 2026 р., 09:51
-- Версія сервера: 8.4.6
-- Версія PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `fts_2025`
--

-- --------------------------------------------------------

--
-- Структура таблиці `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(27, 'fts', 'fts', '1771411787.png', '2026-02-18 08:49:48', '2026-02-18 08:49:48'),
(28, 'bravomix', 'bravomix', '1771411882.jpg', '2026-02-18 08:51:22', '2026-02-18 08:51:22');

-- --------------------------------------------------------

--
-- Структура таблиці `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `parent_id`, `created_at`, `updated_at`) VALUES
(6, 'пінопласт', 'pinoplast', '1771411659.jpg', NULL, '2026-02-18 08:47:42', '2026-02-18 08:47:42'),
(7, 'Сухі суміші', 'suxi-sumisi', '1771411704.jpg', NULL, '2026-02-18 08:48:24', '2026-02-18 08:48:24'),
(8, 'Штукатурки фасадні', 'stukaturki-fasadni', '1771411741.png', NULL, '2026-02-18 08:49:01', '2026-02-18 08:49:01');

-- --------------------------------------------------------

--
-- Структура таблиці `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `cart_value` decimal(8,2) NOT NULL,
  `expire_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `failed_jobs`
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
-- Структура таблиці `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '0001_01_01_000000_create_users_table', 1),
(5, '0001_01_01_000001_create_cache_table', 1),
(6, '0001_01_01_000002_create_jobs_table', 1),
(7, '2025_12_23_070623_create_brands_table', 2),
(8, '2025_12_29_095611_create_categories_table', 3),
(9, '2025_12_29_122108_create_products_table', 4),
(10, '2026_02_20_070720_create_coupons_table', 5);

-- --------------------------------------------------------

--
-- Структура таблиці `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) DEFAULT NULL,
  `SKU` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_status` enum('instock','outofstock') COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `quantity` int UNSIGNED NOT NULL DEFAULT '10',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `regular_price`, `sale_price`, `SKU`, `stock_status`, `featured`, `quantity`, `image`, `images`, `category_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(15, 'EPS S', 'eps-s', 'Виробництво пінополістирольних  плит BRAVOMIX  EPS S відбувається на новітньому обладнанні виключно з високоякісної сировини, що забезпечує високу якість продукції. Рекомендовано застосовувати в системах, що не створюють механічного навантаження на утеплювач.', 'Сфера застосування\r\nтермоізоляція в каркасних стінах зовнішнього та внутрішнього типу;\r\nтермоізоляція у конструкціях типу «тришарових» стін;\r\nтермоізоляція внутрішніх перегородок і стін;\r\nтермоізоляція перекриттів знизу з подальшим облицюванням;\r\nтермоізоляція легких перекриттів на основі каркасної конструкції з облицювальним шаром;\r\nтермоізоляція дахів з похилою конструкцією між кроквами;\r\nтермоізоляція тимчасових споруд, вагонів, холодильних камер;\r\nвикористання у виготовленні меблів, зокрема як пакувальний матеріал або як елемент безкаркасних виробів;\r\nінші будівельні чи промислові рішення, де відсутнє механічне навантаження на теплоізоляційний матеріал.', 1075.00, 1070.00, '2026-1', 'instock', 0, 1, '1771412508.jpg', '1771412754-1.jpg', 6, 28, '2026-02-18 09:01:48', '2026-02-18 09:05:55'),
(16, 'EPS 30', 'eps-30', 'Вартість пінопласту вказана за 1 м³', 'Виробництво пінополістирольних  плит BRAVOMIX  EPS 30 відбувається на новітньому обладнанні виключно з високоякісної сировини, що забезпечує високу якість продукції. Рекомендовано застосовувати в системах, що не створюють механічного навантаження на утеплювач.\r\n\r\nСфера застосування:\r\n• для зовнішньої теплоізоляції в будівельних спорудах;\r\n\r\n• для теплоізоляції фасадів з використанням сайдингу, профнастилу, тощо;\r\n\r\n• для утеплення внутрішніх стін та перегородок;\r\n\r\n• для звуко- і теплоізоляції в каркасних конструкціях та в машинобудуванні;\r\n\r\n• для виконання теплоізоляції в дахах між кроквами та під ними; підвісних стелях;\r\n\r\n• для упаковки продукції харчової та меблевої промисловості.\r\n\r\nПри виробництві допустимі відхилення від мінімальних лінійних розмірів плит: по довжині та ширині до 5мм, по товщині до 3мм. Можна виконувати індивідуальні замовлення розмірів пінополасту.\r\n\r\nПризначення об’єктів, в яких планується виконувати теплоізоляцію є різними. А тому товщину та марку пінополістирольних плит необхідно обирати згідно проектних вимог будівництва, враховуючи практичні поради спеціалістів та дотримуючись при цьому вимог діючого законодавства України. Крім цього, Ви завжди зможете скористатися допомогою – отримати необхідну консультацію у менеджерів нашої компанії для оптимізації показників теплоізоляції.', 1234.00, 1230.00, '2026-2', 'instock', 0, 1, '1771412709.webp', '1771412709-1.webp', 6, 28, '2026-02-18 09:04:57', '2026-02-18 09:05:10'),
(17, 'TERMO 1', 'termo-1', 'Клей для пінопласту FTS TERMO 1 – суха суміш на цементній основі, призначена для приклеювання пінополістирольних теплоізоляційних плит в системі утеплення FTS.', 'Клей для пінопласту FTS TERMO 1 – суха суміш на цементній основі, призначена для приклеювання пінополістирольних теплоізоляційних плит в системі утеплення FTS. Екологічно чиста клейова суміш має високу адгезію до мінеральних та органічних основ, еластична, паропроникна, атмосферостійка, зручна у використанні.\r\n\r\nСклад\r\n\r\nКлей для пінопласту FTS TERMO 1 – суміш цементу з мінеральними наповнювачами і добавками.\r\n\r\nЗастосування та нанесення\r\n\r\nПоверхня основи повинна бути сухою, міцною, очищеною від бруду, масляних плям та інших речовин, що знижують адгезію клейового розчину. Штукатурною масою вирівняти значні нерівності та тріщини. Після цього основу необхідно погрунтувати грунтом глибокого проникнення FTS. Клей для пінопласту FTS TERMO 1 насипати у ємність з водою з розрахунку 0,18-0,23 л на 1 кг сухої суміші і перемішати до отримання однорідної, еластичної маси. Клейовий розчин витримати 5 хвилин, після чого знову перемішати та використати на протязі 2-х годин. В залежності від величини нерівностей поверхні основи, що утеплюється, обирають один із способів приклеювання пінополістирольних плит: \r\n\r\n– суцільний – якщо поверхня стіни має нерівності до 5мм, клейову суміш наносять тонким\r\n\r\nсуцільним шаром по всій поверхні плити, а потім вирівнюють зубчастим шпателем із розміром зубця 10Х10мм. При цьому\r\n\r\nклейовий розчин повинен бути видалений від країв утеплювача на 10-15мм. \r\n\r\n– смуговий – коли поверхня стіни має нерівності до 10мм, приготовлений клейовий розчин наносять на утеплювач у вигляді смуг шириною 60мм і висотою 20мм, на відстані 15-20мм від країв по всьому його периметру, а потім посередині у два ряди. Щоб запобігти утворенню повітряних пробок при приклеюванні пінополістирольних плит, нанесені смуги повинні мати розриви між собою 30-50мм.\r\n\r\n – маяковий – якщо основа має нерівності до 15мм, клейову суміш наносять на поверхню плити розривними смугами шириною 60мм і висотою 20мм, на відстані 15-20мм від країв утеплювача по всьому його периметру, а потім посередині грудками у вигляді маяків з розрахунку 5-8 штук діаметром близько 100мм на плиту розміром 0,5мХ1,0м.\r\n\r\nНезалежно від обраного способу приклеювання пінополістирольних плит, клейова суміш повинна займати не менше 60% площі утеплювача. Після нанесення клею, плиту слід одразу встановити в проектне положення і притиснути до поверхні. Плити потрібно приклеювати щільно одна до одної в одній площині та не допускати збігу вертикальних швів. Ширина швів не повинна перевищувати 2-х мм. Не наносити клейовий розчин на бокові грані плити утеплювача, оскільки він буде утворювати «теплові містки», знижуючи при цьому ефективність всієї системи утеплення. Залишки клейової суміші слід видалити до її затвердіння за допомогою шпателя. Механічне кріплення фасадними дюбелями пінополістирольних плит виконують через 2-3 доби після їх приклеювання до основи.Приклеювання пінополістирольних плит слід виконувати при температурі від +5°С до + 30°С та відносній вологості повітря не більше 80%. Поверхню стін під час приклеювання утеплювача слід оберігати від попадання прямих сонячних променів та дощу. Не виконувати роботи при сильному вітрові. Після закінчення робіт інструмент помити водою. Ефективність вищенаведених рекомендацій є максимальною при температурі +20°С та відносній вологості повітря – 60%. Тоді затвердіння клею відбувається через 2-3 доби, а тужавіння – після 7-ми діб. За інших умов ці показники можуть змінюватися.\r\n\r\nЗапобіжні заходи\r\n\r\nПід час виконання робіт берегти очі та шкіру. При попаданні клейового розчину в очі, негайно промити їх водою, при необхідності звернутися за допомогою до лікаря. Невикористаний клейовий розчин не виливати в каналізацію. Залишки продукту утилізувати як будівельне сміття.\r\n\r\nЗберігання\r\n\r\nГарантійний термін зберігання в сухих приміщеннях на піддонах, у фірмових мішках – 12 місяців від дати виготовлення, вказаної на упаковці. Номер партії відповідає даті виготовлення.\r\n\r\nУпаковка\r\n\r\nКлей для пінопласту FTS TERMO 1 фасується в паперові мішки по 25 кг, 42 шт. на піддоні.', 190.00, 180.00, '2026-3', 'instock', 0, 1, '1771412914.webp', '1771412914-1.webp', 7, 27, '2026-02-18 09:08:34', '2026-02-18 09:08:34'),
(18, 'G-410 | Мозаїчна штукатурка', 'g-410-', 'Мозаїчна штукатурка GRANIT є високоякісним декоративно-оздоблювальним матеріалом, виготовленим на основі мармурової крихти, слюди. Розмір зерна 1,2мм.', 'Застосування та нанесення\r\n\r\nМозаїчна штукатурка STONE LINE GRANIT призначена для нанесення на армований шар в системі утеплення FTS із використанням пінополістиролу, мінеральні та бетонні поверхні, гіпсокартонні і деревостружкові плити. Відмінні декоративно-покривні якості штукатурки сприяють її широкому застосуванню як для зовнішніх фрагментів фа саду (цоколь, стіни, віконні та дверні відкоси, ог ороджувальні стовпчики), так і для оздоблення всередині примі щень (колони, стіни, пілястри та інші частини будівельних конструкцій). Будучи міцною і стійкою до механічних пошкоджень, мозаїчна штукатурка ефективно використовується як оздоблювальний матеріал в приміщеннях адміністративно-побутового типу. Штукатурка наноситься на чисту, гладку, суху та тверду основу, попередньо погрунтовану кварцовим грунтом FTS. Штукатурку перед нанесенням потрібно ретельно перемішати та звірити її відповідність згідно замовлення. При необхідності поступово розбавляти водою (але не більше 2% від ваги штукатурки) до належної консистенції. Наносити рівномірним шаром по всій поверхні на товщину зерна за допомогою нержавіючого шпателя по визначених архітектурни х межах за один робочий цикл. Для збереження ідентичності кольору на одній площині рекомендується використовувати мат еріал однієї партії, номер якої вказаний на кришці.\r\n\r\nУмови нанесення\r\n\r\nШтукатурку наносити при температурі від +10°С до +25°С та відносній вологості повітря не більше 80%. При температурі навколишнього середовища +20°С та відносній вологості повітря 60% висихання мозаїчної штукатурки відбудеться після 24-х годин. За інших погодних умов цей процес може тривати 24-48 годин. Нанесенню мозаїчної штукатурки на примикаючі до поверхні землі бетонні та інші мінеральні основи (цоколь, стовпчики, стіни підвальних приміщень) має передувати їхня професійно виконана гідроізоляція і водовідведення від будинку, а також для захисту від вологої основи, – теплоізоляція пінополістирольними плитами високої щільності товщиною не менше 2см. Це не допустить «здуття» або відшарування мозаїчної штукатурки та збільшить термін її експлуатації. Висихання штукатурки всередині приміщень повинно супроводжуватись їхнім постійним провітрюванням. До повного висихання оберігати штукатурку від дощу. Не наносити штукатурку в спекотну погоду, при сильному вітрі та при попаданні на поверхню прямих сонячних променів. Після закінчення робіт інструмент помити водою.\r\n\r\nЗапобіжні заходи\r\n\r\nПід час нанесення штукатурки берегти очі та шкіру. У випадку попадання штукатурної маси в очі, негайно промити їх водою, при необхідності звернутися за допомогою до лікаря.\r\n\r\nЗберігання\r\n\r\nОберігати мозаїчну штукатурку від попадання прямих сонячних променів та морозу. Гарантійний термін зберігання в герметично закритій фірмовій тарі при температурі від +5°С до +35°С – 12 місяців від дати виготовлення. Дата виготовлення вказана на кришці.\r\n\r\nТара\r\n\r\n18кг (відро).\r\n\r\n \r\n\r\nСередній розхід:\r\n\r\nGRANIT 1,2мм - 1,9-2,2 кг/м²', 1711.00, 1700.00, '2026-4', 'instock', 1, 1, '1771413269.png', '1771413269-1.webp', 8, 27, '2026-02-18 09:14:29', '2026-02-18 09:14:29');

-- --------------------------------------------------------

--
-- Структура таблиці `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HhpQUrFJwLO9S5VtJu5hg5KiL8LcXaOTKoww4RLw', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibTdKV3BSazFMOTZXOFpuUFE2MkdGVkc4c2dxcjFkUXJWUW40VlhkZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9jb3Vwb25zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo0OiJjYXJ0IjthOjI6e3M6ODoid2lzaGxpc3QiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjA6e31zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NDoiY2FydCI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTp7czozMjoiYTRlOTM1YTc1ODEyNjY3YTg0OWYzZGZlZjFjNTk0MGIiO086MzU6IlN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtIjo5OntzOjU6InJvd0lkIjtzOjMyOiJhNGU5MzVhNzU4MTI2NjdhODQ5ZjNkZmVmMWM1OTQwYiI7czoyOiJpZCI7czoyOiIxNyI7czozOiJxdHkiO3M6MToiMSI7czo0OiJuYW1lIjtzOjc6IlRFUk1PIDEiO3M6NToicHJpY2UiO2Q6MTgwO3M6Nzoib3B0aW9ucyI7Tzo0MjoiU3VyZnNpZGVtZWRpYVxTaG9wcGluZ2NhcnRcQ2FydEl0ZW1PcHRpb25zIjoyOntzOjg6IgAqAGl0ZW1zIjthOjA6e31zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NTI6IgBTdXJmc2lkZW1lZGlhXFNob3BwaW5nY2FydFxDYXJ0SXRlbQBhc3NvY2lhdGVkTW9kZWwiO3M6MTg6IkFwcFxNb2RlbHNcUHJvZHVjdCI7czo0NDoiAFN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAHRheFJhdGUiO2k6MjE7czo0NDoiAFN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGlzU2F2ZWQiO2I6MDt9fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzcxNTcyODkwO319', 1771573855),
('PSBeDPa88Ls3RsUYjGY83JpywHbdHpeEgIWnH98z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia2ZxQlBvaG80RjNRaWxPM21CZ0dBdVlaRFU1VlllWm1IVjQyTFdJeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo0OiJjYXJ0IjthOjM6e3M6ODoid2lzaGxpc3QiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjA6e31zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NzoiZGVmYXVsdCI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Mjp7czozMjoiYTRlOTM1YTc1ODEyNjY3YTg0OWYzZGZlZjFjNTk0MGIiO086MzU6IlN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtIjo5OntzOjU6InJvd0lkIjtzOjMyOiJhNGU5MzVhNzU4MTI2NjdhODQ5ZjNkZmVmMWM1OTQwYiI7czoyOiJpZCI7czoyOiIxNyI7czozOiJxdHkiO3M6MToiMSI7czo0OiJuYW1lIjtzOjc6IlRFUk1PIDEiO3M6NToicHJpY2UiO2Q6MTgwO3M6Nzoib3B0aW9ucyI7Tzo0MjoiU3VyZnNpZGVtZWRpYVxTaG9wcGluZ2NhcnRcQ2FydEl0ZW1PcHRpb25zIjoyOntzOjg6IgAqAGl0ZW1zIjthOjA6e31zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NTI6IgBTdXJmc2lkZW1lZGlhXFNob3BwaW5nY2FydFxDYXJ0SXRlbQBhc3NvY2lhdGVkTW9kZWwiO3M6MTg6IkFwcFxNb2RlbHNcUHJvZHVjdCI7czo0NDoiAFN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAHRheFJhdGUiO2k6MjE7czo0NDoiAFN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGlzU2F2ZWQiO2I6MDt9czozMjoiMzAzYTdmMDIzNjRmMWU5MmRjNjBjMDVjOWIxNTIzOWYiO086MzU6IlN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtIjo5OntzOjU6InJvd0lkIjtzOjMyOiIzMDNhN2YwMjM2NGYxZTkyZGM2MGMwNWM5YjE1MjM5ZiI7czoyOiJpZCI7czoyOiIxOCI7czozOiJxdHkiO3M6MToiMSI7czo0OiJuYW1lIjtzOjQ1OiJHLTQxMCB8INCc0L7Qt9Cw0ZfRh9C90LAg0YjRgtGD0LrQsNGC0YPRgNC60LAiO3M6NToicHJpY2UiO2Q6MTcwMDtzOjc6Im9wdGlvbnMiO086NDI6IlN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtT3B0aW9ucyI6Mjp7czo4OiIAKgBpdGVtcyI7YTowOnt9czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO31zOjUyOiIAU3VyZnNpZGVtZWRpYVxTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AYXNzb2NpYXRlZE1vZGVsIjtzOjE4OiJBcHBcTW9kZWxzXFByb2R1Y3QiO3M6NDQ6IgBTdXJmc2lkZW1lZGlhXFNob3BwaW5nY2FydFxDYXJ0SXRlbQB0YXhSYXRlIjtpOjIxO3M6NDQ6IgBTdXJmc2lkZW1lZGlhXFNob3BwaW5nY2FydFxDYXJ0SXRlbQBpc1NhdmVkIjtiOjA7fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6NDoiY2FydCI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTp7czozMjoiYWI0NzRhNzI0NzVlYTZlYTU0ZDIwODVlNWNkYWNjMjgiO086MzU6IlN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtIjo5OntzOjU6InJvd0lkIjtzOjMyOiJhYjQ3NGE3MjQ3NWVhNmVhNTRkMjA4NWU1Y2RhY2MyOCI7czoyOiJpZCI7czoyOiIxNSI7czozOiJxdHkiO3M6MToiMSI7czo0OiJuYW1lIjtzOjU6IkVQUyBTIjtzOjU6InByaWNlIjtkOjEwNzA7czo3OiJvcHRpb25zIjtPOjQyOiJTdXJmc2lkZW1lZGlhXFNob3BwaW5nY2FydFxDYXJ0SXRlbU9wdGlvbnMiOjI6e3M6ODoiACoAaXRlbXMiO2E6MDp7fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9czo1MjoiAFN1cmZzaWRlbWVkaWFcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGFzc29jaWF0ZWRNb2RlbCI7czoxODoiQXBwXE1vZGVsc1xQcm9kdWN0IjtzOjQ0OiIAU3VyZnNpZGVtZWRpYVxTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AdGF4UmF0ZSI7aToyMTtzOjQ0OiIAU3VyZnNpZGVtZWRpYVxTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AaXNTYXZlZCI7YjowO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO319fQ==', 1771512297);

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `utype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USR' COMMENT 'ADM for Admin and Usr for User or Customer',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `utype`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Chaim Riddle', 'luwybod@mailinator.com', '0660173965', '2025-12-23 14:04:24', '$2y$12$kGDizaTuJor.9tii0O1dWuIWQAmndqrukAh.JDLh/QX8kgDHoelXm', 'ADM', NULL, '2025-12-23 12:03:43', '2025-12-23 12:03:43');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Індекси таблиці `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Індекси таблиці `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Індекси таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Індекси таблиці `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Індекси таблиці `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`SKU`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Індекси таблиці `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблиці `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
