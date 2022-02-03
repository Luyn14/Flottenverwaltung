DROP DATABASE IF EXISTS Fleetmanagement_Website;

CREATE DATABASE Fleetmanagement_Website;

USE Fleetmanagement_Website;

/* Create's */

CREATE TABLE tSpaceshiprole (
	SpaceshiproleID INT NOT NULL auto_increment,
	Rolename VARCHAR(200),
	PRIMARY KEY (SpaceshiproleID)
);

CREATE INDEX iRolename_spaceship
ON tSpaceshiprole (Rolename);

CREATE TABLE tShipequipment (
	ShipequipmentID INT NOT NULL auto_increment,
	Equipmentname VARCHAR(200),
	Equipmentsize INT,
	PRIMARY KEY (ShipequipmentID)
);

CREATE INDEX iShipequipment_name_size
ON tShipequipment (Equipmentname, Equipmentsize);

CREATE TABLE tCrewrole (
	CrewroleID INT NOT NULL auto_increment,
	Rolename VARCHAR(200),
	PRIMARY KEY (CrewroleID)
);

CREATE INDEX iCrewrole_name
ON tCrewrole (Rolename);

CREATE TABLE tCrew (
	CrewID INT NOT NULL auto_increment,
	Prename VARCHAR(200),
	Lastname VARCHAR(200),
	Birthday VARCHAR(200),
	Password VARCHAR(200),
	CrewroleFID INT,
	PRIMARY KEY (CrewID),
	FOREIGN KEY (CrewroleFID) REFERENCES tCrewrole(CrewroleID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX iCrew_name
ON tCrew (Prename, Lastname);

CREATE TABLE tCargohold (
	CargoholdID INT NOT NULL auto_increment,
	Cargoname VARCHAR(200),
	PRIMARY KEY (CargoholdID)
);

CREATE INDEX iCargohold_name
ON tCargohold (Cargoname);

CREATE TABLE tAmmunitionhold (
	AmmunitionholdID INT NOT NULL auto_increment,
	Ammunitionname VARCHAR(200),
	PRIMARY KEY (AmmunitionholdID)
);

CREATE INDEX iAmmunitionhold_name
ON tAmmunitionhold (Ammunitionname);

CREATE TABLE tMoon (
	MoonID INT NOT NULL auto_increment,
	Moonname VARCHAR(200),
	PRIMARY KEY (MoonID)
);

CREATE INDEX iMoon_name
ON tMoon (Moonname);

CREATE TABLE tDestination (
	DestinationID INT NOT NULL auto_increment,
	Destinationname VARCHAR(200),
	PRIMARY KEY (DestinationID)
);

CREATE INDEX iDestination_name
ON tDestination (Destinationname);

CREATE TABLE tFleet (
	FleetID INT NOT NULL auto_increment,
	FleetName VARCHAR(200),
	PRIMARY KEY (FleetID)
);

CREATE INDEX iFleet_name
ON tFleet (FleetName);

CREATE TABLE tDivision (
	DivisionID INT NOT NULL auto_increment,
	Divisionname VARCHAR(200),
	FleetFID INT,
	PRIMARY KEY (DivisionID),
	FOREIGN KEY (FleetFID) REFERENCES tFleet(FleetID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX iDivision_name
ON tDivision (Divisionname);

CREATE TABLE tDest_Moon (
	DestMoonID INT NOT NULL auto_increment,
	DestinationFID INT,
	MoonFID INT,
	PRIMARY KEY (DestMoonID),
	FOREIGN KEY (DestinationFID) REFERENCES tDestination(DestinationID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (MoonFID) REFERENCES tMoon(MoonID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX iDest_Moon_Foreignkey
ON tDest_Moon (DestinationFID, MoonFID);

CREATE TABLE tSpaceship (
	SpaceshipID INT NOT NULL auto_increment,
	Shipname VARCHAR(200),
	DivisionFID INT, 
	SpaceshiproleFID INT,
	DestmoonFID INT,
	PRIMARY KEY (SpaceShipID),
	FOREIGN KEY (DivisionFID) REFERENCES tDivision(DivisionID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (SpaceshiproleFID) REFERENCES tSpaceshiprole(SpaceshiproleID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (DestmoonFID) REFERENCES tDest_Moon(DestmoonID) ON UPDATE CASCADE ON DELETE CASCADE
); 

CREATE INDEX iSpaceship_shipname_shiprole
ON tSpaceship (Shipname, SpaceshiproleFID);

CREATE INDEX iSpaceship_shipname_destmoon
ON tSpaceship (Shipname, DestmoonFID);

CREATE TABLE tSpaceship_Shipequipment (
	SpaceshipFID INT,
	ShipequipmentFID INT,
	Equipmentamount INT,
	PRIMARY KEY (SpaceshipFID, ShipequipmentFID),
    FOREIGN KEY (SpaceshipFID) REFERENCES tSpaceship(SpaceshipID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (ShipequipmentFID) REFERENCES tShipequipment(ShipequipmentID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX iSpaceship_Shipequipment_amount
ON tSpaceship_Shipequipment (Equipmentamount);

CREATE TABLE tCrew_Spaceship (
	CrewFID INT,
	SpaceshipFID INT,
	PRIMARY KEY (CrewFID, SpaceshipFID),
	FOREIGN KEY (CrewFID) REFERENCES tCrew(CrewID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (SpaceshipFID) REFERENCES tSpaceship(SpaceshipID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX iCrew_Spaceship_FID
ON tCrew_Spaceship (SpaceshipFID);

CREATE TABLE tSpaceship_Cargo (
	SpaceshipFID INT,
	CargoholdFID INT,
	Cargoamount INT,
	PRIMARY KEY (SpaceshipFID, CargoholdFID),
	FOREIGN KEY (SpaceshipFID) REFERENCES tSpaceship(SpaceshipID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (CargoholdFID) REFERENCES tCargohold(CargoholdID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX iSpaceship_Cargo_amount
ON tSpaceship_Cargo (Cargoamount);

CREATE TABLE tSpaceship_Ammunition (
	SpaceshipFID INT,
	AmmunitionholdFID INT,
	Ammunitionamount INT,
	PRIMARY KEY (SpaceshipFID, AmmunitionholdFID),
	FOREIGN KEY (SpaceshipFID) REFERENCES tSpaceship(SpaceshipID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (AmmunitionholdFID) REFERENCES tAmmunitionhold(AmmunitionholdID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE INDEX iSpaceship_Ammunition_amount
ON tSpaceship_Ammunition (Ammunitionamount);

/* Inserts */


INSERT INTO tSpaceshiprole 
	(SpaceshiproleID, Rolename)
	VALUES
	(1, "Gunship"),
	(2, "Scout"),
	(3, "Frigate"),
	(4, "Freighter"),
	(5, "Cruiser"),
	(6, "Destroyer"),
	(7, "Capitalship");
	-- (x, "x");

INSERT INTO tShipequipment
	(ShipequipmentID, Equipmentname, Equipmentsize)
	VALUES
	(1, "Shieldgenerator", 1),
	(2, "Shieldgenerator", 2),
	(3, "Shieldgenerator", 3),
	(4, "Shieldgenerator", 4),
	(5, "Cooler", 1),
	(6, "Cooler", 2),
	(7, "Cooler", 3),
	(8, "Cooler", 4),
	(9, "Power-Plant", 1),
	(10, "Power-Plant", 2),
	(11, "Power-Plant", 3),
	(12, "Power-Plant", 4),
	(13, "Laser-Repeater", 1),
	(14, "Laser-Repeater", 2),
	(15, "Laser-Repeater", 3),
	(17, "Laser-Repeater", 4),
	(18, "Gatling-Gun", 1),
	(19, "Gatling-Gun", 2),
	(20, "Gatling-Gun", 3),
	(21, "Gatling-Gun", 4),
	(22, "Heat-Missile", 1),
	(23, "Heat-Missile", 2),
	(24, "Heat-Missile", 3),
	(25, "Heat-Missile", 4),
	(26, "Flair-Launcher", 1),
	(27, "Flair-Launcher", 2);
	-- (x, "x", x);

INSERT INTO tCargohold
	(CargoholdID, Cargoname)
	VALUES
	(1, "Iron-ore [kg]"),
	(2, "Copper-ore [kg]"),
	(3, "Lithium-ore [kg]"),
	(4, "MRE-Pack"),
	(5, "Textile [kg]"),
	(6, "Scrap [kg]"),
	(7, "Spacesuit"),
	(8, "Water [l]");
	-- (x, "x");

INSERT INTO tAmmunitionhold
	(AmmunitionholdID, Ammunitionname)
	VALUES
	(1, "Ballistic-Ammuniton (Size 1)"),
	(2, "Ballistic-Ammuniton (Size 2)"),
	(3, "Ballistic-Ammuniton (Size 3)"),
	(4, "Ballistic-Ammuniton (Size 4)"),
	(5, "9mm-Magazin"),
	(6, "5,56x45-Magazin"),
	(7, "7,62x39-Magazin"),
	(8, "Flair (Size 1)"),
	(9, "Flair (Size 2)");
	-- (x, "x");

INSERT INTO tCrewrole
	(CrewroleID, Rolename)
	VALUES
	(1, "Admiral"),
	(2, "Commander"),
	(3, "Captain"),
	(4, "Soldier"),
	(5, "Mechanic"),
	(6, "Worker");
	-- (x, "x");

INSERT INTO tCrew 
	(CrewID, Prename, Lastname, Birthday, Password, CrewroleFID)
	VALUES
	(1, "Luca", "Luu", "23.11.75", "123", 1),
	(2, "Michael", "Frantzes", "9.1.77", "123", 2),
	(3, "Donald", "Tate", "30.3.81", "123", 2),
	(4, "Ryan", "King", "10.12.74", "123", 3),
	(5, "Roland", "Sherman", "23.11.72", "123", 3),
	(6, "Nick", "Lauda", "11.5.83", "123", 3),
	(7, "Nedo", "Lui", "3.7.69", "123", 3);

	-- (x, "x", "x", x, x);

INSERT INTO tDestination
	(DestinationID, Destinationname)
	VALUES
	(1, "Mercury"),
	(2, "Venus"),
	(3, "Earth"),
	(4, "Mars"),
	(5, "Jupiter"),
	(6, "Saturn"),
	(7, "Uranus"),
	(8, "Neptun"),
	(9, "Pluto");
	-- (x, "x");

INSERT INTO tMoon
	(MoonID, Moonname)
	VALUES
	(1, "Planetside"),
	(2, "Moon"),
	(3, "Phobos"),
	(4, "Deimos"),
	(5, "Ganymed"),
	(6, "Kallisto"),
	(7, "Io"),
	(8, "Europa"),
	(9, "Titan"),
	(10, "Rhea"),
	(11, "Iapetus"),
	(12, "Dione"),
	(13, "Titania"),
	(14, "Oberon"),
	(15, "Umbriel"),
	(16, "Ariel"),
	(17, "Triton"),
	(18, "Proteus"),
	(19, "Nereid"),
	(20, "Charon");

	-- (x, "x");

INSERT INTO tDest_Moon
	(DestmoonID, DestinationFID, MoonFID)
	VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 3, 2),
	(5, 4, 1),
	(6, 4, 3),
	(7, 4, 4),
	(8, 5, 1),
	(9, 5, 5),
	(10, 5, 6),
	(11, 5, 7),
	(12, 5, 8),
	(13, 6, 1),
	(14, 6, 9),
	(15, 6, 10),
	(16, 6, 11),
	(17, 6, 12),
	(18, 7, 1),
	(19, 7, 13),
	(20, 7, 14),
	(21, 7, 15),
	(22, 7, 16),
	(23, 8, 1),
	(24, 8, 17),
	(25, 8, 18),
	(26, 8, 19),
	(27, 8, 20),
	(28, 9, 1);

	-- (x, x, x);


INSERT INTO tFleet
	(FleetID, Fleetname)
	VALUES
	(1, "GuiltySpark");
	-- (x, "x");

INSERT INTO tDivision 
	(DivisionID, Divisionname, FleetFID)
	VALUES
	(1, "Maindivison", 1),
	(2, "Frontdivison", 1);
	-- (x, "x", x, x);

INSERT INTO tSpaceship
	(SpaceshipID, Shipname, DivisionFID, SpaceshiproleFID, DestmoonFID)
	VALUES
	(1, "Pillar of Autumn", 1, 7, 3),
	(2, "Nexus", 1, 6, 4),
	(3, "Bolt", 2, 5, 4 ),
	(4, "Passasge", 2, 3, 5);
	-- (x, "x", x, x, x);

INSERT INTO tCrew_Spaceship
	(CrewFID, SpaceshipFID)
	VALUES
	(1, 1),
	(2, 1),
	(3, 2),
	(4, 1),
	(5, 2),
	(6, 3),
	(7, 4);

	-- (x, x);

INSERT INTO tSpaceship_Ammunition
	(SpaceshipFID, AmmunitionholdFID, Ammunitionamount)
	VALUES
	(1, 4, 20000),
	(1, 5, 250),
	(1, 6, 150),
	(1, 7, 150),
	(1, 9, 50),
	(2, 2, 15000),
	(2, 5, 150),
	(2, 6, 100),
	(2, 7, 120),
	(2, 8, 60),
	(3, 2, 12000),
	(3, 5, 200),
	(3, 6, 150),
	(3, 7, 100),
	(3, 8, 40),
	(4, 9, 50);
	-- (x, x, x);
	
INSERT INTO tSpaceship_Cargo
	(SpaceshipFID, CargoholdFID, Cargoamount)
	VALUES
	(1, 1, 15000),
	(1, 2, 6000),
	(1, 3, 3000),
	(1, 4, 300),
	(1, 7, 20000),
	(1, 8, 5000),
	(2, 1, 10000),
	(2, 2, 3000),
	(2, 3, 6000),
	(2, 4, 500),
	(2, 6, 10000),
	(2, 8, 10000),
	(3, 1, 8000),
	(3, 2, 2000),
	(3, 3, 3000),
	(3, 4, 250),
	(3, 7, 8000),
	(3, 8, 9000),
	(4, 1, 35000),
	(4, 2, 9000),
	(4, 3, 5000),
	(4, 4, 200),
	(4, 5, 6000),
	(4, 6, 600),
	(4, 7, 16000),
	(4, 8, 12000);
	-- (x, x, x);

INSERT INTO tSpaceship_Shipequipment
	(SpaceshipFID, ShipequipmentFID, Equipmentamount)
	VALUES
	(1, 4, 2),
	(1, 5, 2),
	(1, 9, 2),
	(1, 13, 4),
	(1, 21, 2),
	(1, 23, 4),
	(1, 27, 1),
	(2, 2, 4),
	(2, 5, 2),
	(2, 9, 2),
	(2, 13, 4),
	(2, 19, 2),
	(2, 22, 4),
	(2, 26, 1),
	(3, 2, 4),
	(3, 6, 3),
	(3, 9, 2),
	(3, 13, 2),
	(3, 19, 4),
	(3, 22, 2),
	(3, 25, 1),
	(4, 2, 2),
	(4, 6, 2),
	(4, 10, 2),
	(4, 14, 2),
	(4, 23, 4),
	(4, 27, 2);

	-- (x, x, x);

	 