-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2023 at 04:16 AM
-- Server version: 8.0.34
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intl_chess_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chess_openings`
--

CREATE TABLE `chess_openings` (
  `opening_ID` int NOT NULL,
  `opening_name` varchar(100) NOT NULL,
  `opening_PGN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chess_openings`
--

INSERT INTO `chess_openings` (`opening_ID`, `opening_name`, `opening_PGN`) VALUES
(1, 'Italian Game', '1.e4 e5 2.Nf3 Nc6 3.Bc4'),
(2, 'Sicilian Defense', '1.e4 c5'),
(3, 'King\'s Indian Defense', '1.d4 Nf6 2.c4 g6'),
(4, 'Queen\'s Gambit Declined', '1.d4 d5 2.c4 e6'),
(5, 'Ruy López', '1.e4 e5 2.Nf3 Nc6 3.Bb5 a6 4.Ba4 Nf6 5.O-O'),
(6, 'King\'s Pawn Game', '1.e4 e5'),
(7, 'King\'s Gambit', '1.e4 e5 2.f4'),
(8, 'Semi-Slav Defense', '1.d4 d5 2.c4 e6 3.Nc3 Nf6 4.Nf3 c6'),
(9, 'Slav-Defense', '1.d4 d5 2.c4 c6'),
(10, 'Bishop\'s Opening', '1.e4 e5 2.Bc4');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_ID` int NOT NULL,
  `date_of_match` date DEFAULT NULL,
  `time_control` int DEFAULT NULL,
  `opening_ID` int NOT NULL,
  `match_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_ID`, `date_of_match`, `time_control`, `opening_ID`, `match_ID`) VALUES
(1, '1851-06-21', NULL, 7, 1),
(2, '1996-02-13', 2, 2, 2),
(3, '1852-01-01', NULL, 1, 3),
(4, '1972-07-23', 2, 4, 4),
(5, '1985-10-15', 3, 2, 5),
(6, '1921-03-26', 3, 5, 6),
(7, '1854-01-01', NULL, 10, 7),
(8, '2013-11-15', 3, 2, 8),
(9, '1985-09-14', 3, 5, 9),
(10, '2006-09-23', 3, 8, 10),
(11, '2010-05-11', 3, 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `game_pgn`
--

CREATE TABLE `game_pgn` (
  `game_ID` int NOT NULL,
  `game_PGN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `game_pgn`
--

INSERT INTO `game_pgn` (`game_ID`, `game_PGN`) VALUES
(1, '1.e4 e5 2.f4 exf4 3.Bc4 Qh4+ 4.Kf1 b5 5.Bxb5 Nf6 6.Nf3 Qh6 7.d3 Nh5 8.Nh4 Qg5 9.Nf5 c6 10.g4 Nf6 11.Rg1 cxb5 12.h4 Qg6 13.h5 Qg5 14.Qf3 Ng8 15.Bxf4 Qf6 16.Nc3 Bc5 17.Nd5 Qxb2 18.Bd6 Bxg1 19. e5 Qxa1+ 20. Ke2 Na6 21.Nxg7+ Kd8 22.Qf6+ Nxf6 23.Be7# 1-0'),
(2, '1.e4 c5 2.c3 d5 3.exd5 Qxd5 4.d4 Nf6 5.Nf3 Bg4 6.Be2 e6 7.O-O Nc6 8.Be3 cxd4 9.cxd4 Bb4 10.a3 Ba5 11.Nc3 Qd6 12.Ne5 Bxe2 13.Qxe2 Bxc3 14.bxc3 Nxe5 15.Bf4 Nf3+ 16.Qxf3 Qd5 17.Qd3 Rc8 18.Rfc1 Qc4 19.Qxc4 Rxc4 20.Rcb1 b6 21.Bb8 Ra4 22.Rb4 Ra5 23.Rc4 O-O 24.Bd6 Ra8 25.Rc6 b5 26.Kf1 Ra4 27.Rb1 a6 28.Ke2 h5 29.Kd3 Rd8 30.Be7 Rd7 31.Bxf6 gxf6 32.Rb3 Kg7 33.Ke3 e5 34.g3 exd4 35.cxd4 Re7+ 36.Kf3 Rd7 37.Rd3 Raxd4 38.Rxd4 Rxd4 39.Rxa6 b4 1/2-1/2'),
(3, '1.e4 e5 2.Nf3 Nc6 3.Bc4 Bc5 4.b4 Bxb4 5.c3 Ba5 6.d4 exd4 7.O-O d3 8.Qb3 Qf6 9.e5 Qg6 10.Re1 Nge7 11.Ba3 b5 12.Qxb5 Rb8 13.Qa4 Bb6 14.Nbd2 Bb7 15.Ne4 Qf5 16.Bxd3 Qh5 17.Nf6+ gxf6 18.exf6 Rg8 19.Rad1 Qxf3 20.Rxe7+ Nxe7 21.Qxd7+ Kxd7 22.Bf5+ Ke8 23.Bd7+ Kf8 24.Bxe7# 1-0'),
(4, '1.c4 e6 2. Nf3 d5 3. d4 Nf6 4. Nc3 Be7 5. Bg5 O-O 6. e3 h6 7. Bh4 b6 8. cxd5 Nxd5 9. Bxe7 Qxe7 10. Nxd5 exd5 11. Rc1 Be6 12. Qa4 c5 13. Qa3 Rc8 14. Bb5 a6 15. dxc5 bxc5 16. O-O Ra7 17. Be2 Nd7 18. Nd4 Qf8 19. Nxe6 fxe6 20. e4 d4 21. f4 Qe7 22. e5 Rb8 23. Bc4 Kh8 24. Qh3 Nf8 25. b3 a5 26. f5 exf5 27. Rxf5 Nh7 28. Rcf1 Qd8 29. Qg3 Re7 30. h4 Rbb7 31. e6 Rbc7 32. Qe5 Qe8 33. a4 Qd8 34. R1f2 Qe8 35. R2f3 Qd8 36. Bd3 Qe8 37. Qe4 Nf6 38. Rxf6 gxf6 39. Rxf6 Kg8 40. Bc4 Kh8 41. Qf4 1-0'),
(5, '1.e4 c5 2.Nf3 e6 3.d4 cxd4 4.Nxd4 Nc6 5.Nb5 d6 6.c4 Nf6 7.N1c3 a6 8.Na3 d5 9.cxd5 exd5 10.exd5 Nb4 11.Be2 Bc5 12.O-O O-O 13.Bf3 Bf5 14.Bg5 Re8 15.Qd2 b5 16.Rad1 Nd3 17.Nab1 h6 18.Bh4 b4 19.Na4 Bd6 20.Bg3 Rc8 21.b3 g5 22.Bxd6 Qxd6 23.g3 Nd7 24.Bg2 Qf6 25.a3 a5 26.axb4 axb4 27.Qa2 Bg6 28.d6 g4 29.Qd2 Kg7 30.f3 Qxd6 31.fxg4 Qd4+ 32.Kh1 Nf6 33.Rf4 Ne4 34.Qxd3 Nf2+ 35.Rxf2 Bxd3 36.Rfd2 Qe3 37.Rxd3 Rc1 38.Nb2 Qf2 39.Nd2 Rxd1+ 40.Nxd1 Re1+ 0-1'),
(6, '1.e4 e5 2.Nf3 Nc6 3.Nc3 Nf6 4.Bb5 d6 5.d4 Bd7 6.O-O Be7 7.Re1 exd4 8.Nxd4 O-O 9.Bxc6 bxc6 10.Bg5 h6 11.Bh4 Re8 12.Qd3 Nh7 13.Bxe7 Rxe7 14.Re3 Qb8 15.b3 Qb6 16.Rae1 Rae8 17.Nf3 Qa5 18.Qd2 Ng5 19.Nxg5 hxg5 20.h3 Re5 21.Rd1 Bc8 22.Rd3 Qb6 23.Kh2 R8e6 24.Rg3 Rf6 25.Kg1 Kf8 26.Na4 Qa5 27.Qxa5 Rxa5 28.Rc3 27. Bb7 29.f3 Re6 30.Rcd3 Ba6 31.Rd4 f6 32.Rc1 c5 33.Rd2 Bb5 34.Nc3 Bc6 35.a4 Ra6 36.Kf2 Rb6 37.Nd1 Kf7 38.Ne3 Rb8 39.Rh1 Ree8 40.Rdd1 Rh8 41.g4 Bd7 42.Nd5 Rb7 43.Kg3 Rh4 44.Rd3 Be6 45.c4 Rh8 46.Rc1 Ke8 47.Ne3 Kd7 48.Ng2 Rbb8 49.Re1 Kc6 50.Ne3 Rbe8 51.Rb1 Rh7 52.Rd2 Rb8 53.Rd3 Rbh8 54.Rh1 Kb6 55.Rh2 Kc6 56.Rh1 Rb8 57.Rh2 Rf8 58.Rh1 Kd7 59.Rh2 Bf7 60.Nf5 Rfh8 61.Ne3 Ke6 62.Nd5 Rc8 63.Ne3 1/2-1/2'),
(7, '1. e4 e5 2. Bc4 b5 3. Bxb5 c6 4. Bc4 Nf6 5. Nc3 Bb4 6. d3 d5 7. exd5 cxd5 8. Bb5+ Kf8 9. Bd2 Qa5 10. a4 a6 11. Nf3 axb5 12. Nxe5 Bxc3 13. bxc3 Qc7 14. f4 bxa4 15. O-O a3 16. c4 a2 17. cxd5 Nxd5 18. c4 Nf6 19. Bc3 Nc6 20. d4 Bf5 21. d5 Ne4 22. Qb3 Qa7+ 23. Kh1 Nd4 24. Qb2 Nc2 25. Nc6 Qc5 26. Rxa2 Re8 27. Ra5 Qd6 28. Bxg7+ Kg8 29. Bxh8 f6 30. Ne5 fxe5 31. Bxe5 Qh6 32. Rf3 Ne1 33. Ra7 Nxf3 34. gxf3 Ng3+ 35. Kg1 Nh5 36. Qg2+ Bg6 37. d6 Nxf4 0-1'),
(8, '1.c4 e6 2.d4 d5 3.Nc3 c6 4.e4 dxe4 5.Nxe4 Bb4+ 6.Nc3 c5 7.a3 Ba5 8.Nf3 Nf6 9.Be3 Nc6 10.Qd3 cxd4 11.Nxd4 Ng4 12.O-O-O Nxe3 13.fxe3 Bc7 14.Nxc6 bxc6 15.Qxd8+ Bxd8 16.Be2 Ke7 17.Bf3 Bd7 18.Ne4 Bb6 19.c5 f5 20.cxb6 fxe4 21.b7 Rab8 22.Bxe4 Rxb7 23.Rhf1 Rb5 24.Rf4 g5 25.Rf3 h5 26.Rdf1 Be8 27.Bc2 Rc5 28.Rf6 h4 29.e4 a5 30.Kd2 Rb5 31.b3 Bh5 32.Kc3 Rc5+ 33.Kb2 Rd8 34.R1f2 Rd4 35.Rh6 Bd1 36.Bb1 Rb5 37.Kc3 c5 38.Rb2 e5 39.Rg6 a4 40.Rxg5 Rxb3+ 41.Rxb3 Bxb3 42.Rxe5+ Kd6 43.Rh5 Rd1 44.e5+ Kd5 45.Bh7 Rc1+ 46.Kb2 Rg1 47.Bg8+ Kc6 48.Rh6+ Kd7 49.Bxb3 axb3 50.Kxb3 Rxg2 51.Rxh4 Ke6 52.a4 Kxe5 53.a5 Kd6 54.Rh7 Kd5 55.a6 c4+ 56.Kc3 Ra2 57.a7 Kc5 58.h4 1-01.c4 e6 2.d4 d5 3.Nc3 c6 4.e4 dxe4 5.Nxe4 Bb4+ 6.Nc3 c5 7.a3 Ba5 8.Nf3 Nf6 9.Be3 Nc6 10.Qd3 cxd4 11.Nxd4 Ng4 12.O-O-O Nxe3 13.fxe3 Bc7 14.Nxc6 bxc6 15.Qxd8+ Bxd8 16.Be2 Ke7 17.Bf3 Bd7 18.Ne4 Bb6 19.c5 f5 20.cxb6 fxe4 21.b7 Rab8 22.Bxe4 Rxb7 23.Rhf1 Rb5 24.Rf4 g5 25.Rf3 h5 26.Rdf1 Be8 27.Bc2 Rc5 28.Rf6 h4 29.e4 a5 30.Kd2 Rb5 31.b3 Bh5 32.Kc3 Rc5+ 33.Kb2 Rd8 34.R1f2 Rd4 35.Rh6 Bd1 36.Bb1 Rb5 37.Kc3 c5 38.Rb2 e5 39.Rg6 a4 40.Rxg5 Rxb3+ 41.Rxb3 Bxb3 42.Rxe5+ Kd6 43.Rh5 Rd1 44.e5+ Kd5 45.Bh7 Rc1+ 46.Kb2 Rg1 47.Bg8+ Kc6 48.Rh6+ Kd7 49.Bxb3 axb3 50.Kxb3 Rxg2 51.Rxh4 Ke6 52.a4 Kxe5 53.a5 Kd6 54.Rh7 Kd5 55.a6 c4+ 56.Kc3 Ra2 57.a7 Kc5 58.h4 1-0'),
(9, '1.e4 e5 2.Nf3 Nc6 3.Bb5 a6 4.Ba4 Nf6 5.O-O Be7 6.Re1 b5 7.Bb3 d6 8.c3 O-O 9.h3 Bb7 10.d4 Re8 11.Nbd2 Bf8 12.a4 Qd7 13.axb5 axb5 14.Rxa8 Bxa8 15.d5 Na5 16.Ba2 c6 17.b4 Nb7 18.c4 Rc8 19.dxc6 Qxc6 20.c5 Nd8 21.Bb2 dxc5 22.bxc5 Qxc5 23.Bxe5 Nd7 24.Bb2 Qb4 25.Nb3 Nc5 26.Ba1 Bxe4 27.Nfd4 Ndb7 28.Qe2 Nd6 29.Nxc5 Qxc5 30.Qg4 Re8 31.Rd1 Bg6 32.Qf4 Qb4 33.Qc1 Be4 34.Re1 Qa5 35.Bb3 Qa8 36.Qb2 b4 37.Re3 Bg6 38.Rxe8 Qxe8 39.Qc1 Ne4 40.Bd5 Nc5 41.Nb3 Nd3 42.Qd2 Qb5 43.Bf3 Qc4 44.Bd1 h6 0-1'),
(10, '1.e4 e5 2.Nf3 Nc6 3.Bb5 a6 4.Ba4 Nf6 5.O-O Be7 6.Re1 b5 7.Bb3 d6 8.c3 O-O 9.h3 Bb7 10.d4 Re8 11.Nbd2 Bf8 12.a4 Qd7 13.axb5 axb5 14.Rxa8 Bxa8 15.d5 Na5 16.Ba2 c6 17.b4 Nb7 18.c4 Rc8 19.dxc6 Qxc6 20.c5 Nd8 21.Bb2 dxc5 22.bxc5 Qxc5 23.Bxe5 Nd7 24.Bb2 Qb4 25.Nb3 Nc5 26.Ba1 Bxe4 27.Nfd4 Ndb7 28.Qe2 Nd6 29.Nxc5 Qxc5 30.Qg4 Re8 31.Rd1 Bg6 32.Qf4 Qb4 33.Qc1 Be4 34.Re1 Qa5 35.Bb3 Qa8 36.Qb2 b4 37.Re3 Bg6 38.Rxe8 Qxe8 39.Qc1 Ne4 40.Bd5 Nc5 41.Nb3 Nd3 42.Qd2 Qb5 43.Bf3 Qc4 44.Bd1 h6 0-1'),
(11, '1.e4 e5 2.Nf3 Nc6 3.Bb5 a6 4.Ba4 Nf6 5.O-O Be7 6.Re1 b5 7.Bb3 d6 8.c3 O-O 9.h3 Bb7 10.d4 Re8 11.Nbd2 Bf8 12.a4 Qd7 13.axb5 axb5 14.Rxa8 Bxa8 15.d5 Na5 16.Ba2 c6 17.b4 Nb7 18.c4 Rc8 19.dxc6 Qxc6 20.c5 Nd8 21.Bb2 dxc5 22.bxc5 Qxc5 23.Bxe5 Nd7 24.Bb2 Qb4 25.Nb3 Nc5 26.Ba1 Bxe4 27.Nfd4 Ndb7 28.Qe2 Nd6 29.Nxc5 Qxc5 30.Qg4 Re8 31.Rd1 Bg6 32.Qf4 Qb4 33.Qc1 Be4 34.Re1 Qa5 35.Bb3 Qa8 36.Qb2 b4 37.Re3 Bg6 38.Rxe8 Qxe8 39.Qc1 Ne4 40.Bd5 Nc5 41.Nb3 Nd3 42.Qd2 Qb5 43.Bf3 Qc4 44.Bd1 h6 0-1');

-- --------------------------------------------------------

--
-- Table structure for table `game_results`
--

CREATE TABLE `game_results` (
  `game_ID` int NOT NULL,
  `result` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `game_results`
--

INSERT INTO `game_results` (`game_ID`, `result`) VALUES
(1, '1-0'),
(2, '1/2-1/2'),
(3, '1-0'),
(4, '1-0'),
(5, '0-1'),
(6, '1/2-1/2'),
(7, '0-1'),
(8, '1-0'),
(9, '0-1'),
(10, '1-0'),
(11, '0-1');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_ID` int NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `match_name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_ID`, `location`, `match_name`, `start_date`, `end_date`) VALUES
(1, 'London, England', 'Anderssen vs Kieseritzky: The Immortal Game (1851)', NULL, NULL),
(2, 'New York City, USA', 'Deep Blue vs Garry Kasparov (Game 4, 1996)', NULL, NULL),
(3, 'Berlin, Germamy', 'Anderssen vs Dufresne: The Evergreen Game (1852)', NULL, NULL),
(4, 'Reykjavik, Iceland', 'Spassky vs Fischer (Game 6, 1972 World Chess Championship)', NULL, NULL),
(5, 'Moscow, USSR', 'Karpov vs. Kasparov (Game 2, 1985 World Chess Championship)', NULL, NULL),
(6, 'Havana, Cuba', 'Capablanca vs Lasker,  (Game 3, 1921 World Chess Championship)', NULL, NULL),
(7, 'Berlin, Germany', 'Anderssen vs Dufresne: The Evergreen Game (1854)', NULL, NULL),
(8, 'Chennai, India', 'Carlsen vs. Anand (Game 5, 2013 World Chess Championship)', NULL, NULL),
(9, 'Moscow, Russia', 'Karpov vs. Kasparov (Game 16, 1985 World Chess Championship)', NULL, NULL),
(10, 'Elista, Russia', 'Kramnik vs. Topalov (Game 1, 2006 World Chess Championship)', NULL, NULL),
(11, 'Sofia, Bulgaria', 'Anand vs. Topalov (Game 12, 2010 World Chess Championship)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_ID` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_ID`, `first_name`, `last_name`, `date_of_birth`, `email`) VALUES
(1, 'Adolf', 'Anderssen', '1818-01-01', NULL),
(2, 'Garry', 'Kasparov', '1963-05-13', 'gkasparov@gmail.com'),
(3, 'Robert', 'Fischer', '1943-03-09', 'fischerBobby@yahoo.com'),
(4, 'Anatoly', 'Karpov', '1951-05-23', 'anakinKarpov@gmail.com'),
(5, 'Anand', 'Viswanathan', '1969-12-11', 'anandnanad@gmail.com'),
(6, 'Jose', 'Capablanca', '1888-11-19', NULL),
(7, 'Emmanuel', 'Lasker', '1868-12-24', NULL),
(8, 'Boris', 'Spasky', '1937-01-30', 'boris.spassky@email.com'),
(9, 'Jean', 'Dufresne', '1816-02-21', NULL),
(10, 'Magnus', 'Carlsen', '1990-11-30', 'magnus.carlsen@email.com'),
(11, 'Veselin', 'Topalov', '1975-03-15', 'veselin.topalov@email.com'),
(12, 'Vladimir', 'Kramnik', '1975-06-25', 'vladkramnik@example.com'),
(13, 'Lionel', 'Kieseritzky', '1806-01-01', NULL),
(14, 'Deep', 'Blue', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `player_details`
--

CREATE TABLE `player_details` (
  `player_ID` int NOT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `FIDE_rating` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `player_details`
--

INSERT INTO `player_details` (`player_ID`, `nationality`, `FIDE_rating`) VALUES
(1, 'German', NULL),
(2, 'Russian', '2812'),
(3, 'American', NULL),
(4, 'Russian', '2627'),
(5, 'Indian', '2753'),
(6, 'Cuban', NULL),
(7, 'German', NULL),
(8, 'Russian', NULL),
(9, 'German', NULL),
(10, 'Norwegian', '2863'),
(11, 'Bulgarian', '2752'),
(12, 'Russian', '2777'),
(13, 'German', NULL),
(14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `player_games`
--

CREATE TABLE `player_games` (
  `player_game_ID` int NOT NULL,
  `game_ID` int NOT NULL,
  `player_ID` int NOT NULL,
  `player_color` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `player_games`
--

INSERT INTO `player_games` (`player_game_ID`, `game_ID`, `player_ID`, `player_color`) VALUES
(1, 1, 1, 'white'),
(2, 1, 13, 'black'),
(3, 2, 14, 'white'),
(4, 2, 2, 'black'),
(5, 3, 1, 'white'),
(6, 3, 9, 'black'),
(7, 4, 3, 'white'),
(8, 4, 8, 'black'),
(9, 5, 4, 'white'),
(10, 5, 2, 'black'),
(11, 6, 8, 'white'),
(12, 6, 7, 'black'),
(13, 7, 1, 'white'),
(14, 7, 13, 'black'),
(15, 8, 10, 'white'),
(16, 8, 5, 'black'),
(17, 9, 2, 'white'),
(18, 9, 4, 'black'),
(19, 10, 12, 'white'),
(20, 10, 11, 'white'),
(21, 11, 11, 'white'),
(22, 11, 5, 'black');

-- --------------------------------------------------------

--
-- Table structure for table `time_controls`
--

CREATE TABLE `time_controls` (
  `control_ID` int NOT NULL,
  `control_name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `initial_time` decimal(10,2) DEFAULT NULL,
  `increment` decimal(5,2) DEFAULT NULL,
  `time_unit` varchar(20) DEFAULT NULL,
  `max_time` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `time_controls`
--

INSERT INTO `time_controls` (`control_ID`, `control_name`, `description`, `initial_time`, `increment`, `time_unit`, `max_time`) VALUES
(1, 'Standard', 'Standard time control', 180.00, 0.00, ' minutes', 0.00),
(2, 'Tournament', 'Tournament time control', 60.00, 30.00, ' minutes', 0.00),
(3, 'World Chess Championship', 'Official time control for World Chess Championship', 120.00, 60.00, 'minutes', 0.00),
(4, 'Rapid', 'Rapid chess time control', 25.00, 10.00, 'minutes', 0.00),
(5, 'Blitz', 'Blitz chess time control', 3.00, 2.00, 'minutes', 0.00),
(6, 'Bullet', 'Bullet chess time control', 1.00, 0.00, ' minutes', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chess_openings`
--
ALTER TABLE `chess_openings`
  ADD PRIMARY KEY (`opening_ID`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_ID`),
  ADD KEY `time_control` (`time_control`),
  ADD KEY `opening_ID` (`opening_ID`),
  ADD KEY `match_ID` (`match_ID`);

--
-- Indexes for table `game_pgn`
--
ALTER TABLE `game_pgn`
  ADD PRIMARY KEY (`game_ID`);

--
-- Indexes for table `game_results`
--
ALTER TABLE `game_results`
  ADD PRIMARY KEY (`game_ID`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_ID`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_ID`);

--
-- Indexes for table `player_details`
--
ALTER TABLE `player_details`
  ADD PRIMARY KEY (`player_ID`);

--
-- Indexes for table `player_games`
--
ALTER TABLE `player_games`
  ADD PRIMARY KEY (`player_game_ID`),
  ADD KEY `player_ID` (`player_ID`),
  ADD KEY `game_ID` (`game_ID`);

--
-- Indexes for table `time_controls`
--
ALTER TABLE `time_controls`
  ADD PRIMARY KEY (`control_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chess_openings`
--
ALTER TABLE `chess_openings`
  MODIFY `opening_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `player_games`
--
ALTER TABLE `player_games`
  MODIFY `player_game_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `time_controls`
--
ALTER TABLE `time_controls`
  MODIFY `control_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`time_control`) REFERENCES `time_controls` (`control_ID`),
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`opening_ID`) REFERENCES `chess_openings` (`opening_ID`),
  ADD CONSTRAINT `games_ibfk_3` FOREIGN KEY (`match_ID`) REFERENCES `matches` (`match_ID`);

--
-- Constraints for table `game_pgn`
--
ALTER TABLE `game_pgn`
  ADD CONSTRAINT `game_pgn_ibfk_1` FOREIGN KEY (`game_ID`) REFERENCES `games` (`game_ID`);

--
-- Constraints for table `game_results`
--
ALTER TABLE `game_results`
  ADD CONSTRAINT `game_results_ibfk_1` FOREIGN KEY (`game_ID`) REFERENCES `games` (`game_ID`);

--
-- Constraints for table `player_details`
--
ALTER TABLE `player_details`
  ADD CONSTRAINT `player_details_ibfk_1` FOREIGN KEY (`player_ID`) REFERENCES `players` (`player_ID`);

--
-- Constraints for table `player_games`
--
ALTER TABLE `player_games`
  ADD CONSTRAINT `player_games_ibfk_1` FOREIGN KEY (`player_ID`) REFERENCES `players` (`player_ID`),
  ADD CONSTRAINT `player_games_ibfk_2` FOREIGN KEY (`game_ID`) REFERENCES `games` (`game_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
