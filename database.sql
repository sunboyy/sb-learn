
CREATE TABLE `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primary` varchar(50) NOT NULL,
  `secondary` varchar(50) NOT NULL,
  `lesson` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `group` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `theme` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
);
