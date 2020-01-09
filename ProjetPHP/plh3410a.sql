CREATE TABLE `carnetadresses` (
  `id` int(4) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adr` varchar(50) NOT NULL,
  `cp` char(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `tel` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `carnetadresses` (`id`, `nom`, `prenom`, `adr`, `cp`, `ville`, `tel`) VALUES
(1, 'PELLOUX222', 'Morgan', 'nulle part', '31400', 'Toulouse', '666776666'),
(2, 'a', 'a', 'a', 'a', 'a', 'a'),
(3, 'PELLOUX', 'a', 'a', 'a', 'a', 'a'),
(4, '', '', '', '', '', ''),
(5, '', '', '', '', '', ''),
(6, '', '', '', '', '', ''),
(7, 'AL MUGHRABI', 'Khaled', '54 AVENUE LOUIS', '31400', 'tOULOUSE', '6544464654'),
(8, 'PELLOUx', 'Morgan', '45454', '445', '45545', '454545457'),
(9, 'AL MUGHRABI', 'aa', 'a', 'a', 'a', 'a');

CREATE TABLE `medecin` (
  `IdMedecin` int(11) NOT NULL,
  `Civilite` varchar(3) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `patient` (
  `IdPatient` int(11) NOT NULL,
  `Civilite` varchar(10) DEFAULT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `Adresse` varchar(50) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `CodePostal` char(5) DEFAULT NULL,
  `LieuNaissance` varchar(50) DEFAULT NULL,
  `NumeroSecurite` char(15) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `IdMedecin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `rendez_vous` (
  `IdMedecin` int(11) NOT NULL DEFAULT 0,
  `IdPatient` int(11) NOT NULL DEFAULT 0,
  `DateRDV` date NOT NULL DEFAULT '0000-00-00',
  `Heure` time NOT NULL DEFAULT '00:00:00',
  `Duree` time DEFAULT '00:30:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `carnetadresses`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `medecin`
  ADD PRIMARY KEY (`IdMedecin`);

ALTER TABLE `patient`
  ADD PRIMARY KEY (`IdPatient`),
  ADD KEY `IdMedecin` (`IdMedecin`);

ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`IdMedecin`,`IdPatient`,`DateRDV`,`Heure`),
  ADD KEY `IdPatient` (`IdPatient`);

ALTER TABLE `carnetadresses`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `medecin`
  MODIFY `IdMedecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `patient`
  MODIFY `IdPatient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `patient`
  ADD CONSTRAINT `Patient_ibfk_1` FOREIGN KEY (`IdMedecin`) REFERENCES `medecin` (`IdMedecin`);

ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `Rendez_vous_ibfk_1` FOREIGN KEY (`IdMedecin`) REFERENCES `medecin` (`IdMedecin`),
  ADD CONSTRAINT `Rendez_vous_ibfk_2` FOREIGN KEY (`IdPatient`) REFERENCES `patient` (`IdPatient`);
COMMIT;