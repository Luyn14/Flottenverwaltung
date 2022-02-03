/* Selects */

-- Gib den Admiral der Flotte aus --
SELECT * FROM tCrew JOIN tCrewrole ON tCrewrole.CrewroleID=CrewroleFID WHERE Rolename = "Admiral"; 

-- Gibt alle Captain der Flotte aus --
SELECT Prename, Lastname, Shipname FROM tFleet 
JOIN tDivision ON tFleet.FleetID=tDivision.FleetFID
JOIN tSpaceship ON tDivision.DivisionID=tSpaceship.DivisionFID
JOIN tCrew_Spaceship ON tSpaceship.SpaceShipID=tCrew_Spaceship.SpaceshipFID
JOIN tCrew ON tCrew_Spaceship.CrewFID=tCrew.CrewID
JOIN tCrewrole ON tCrew.CrewroleFID=tCrewrole.CrewroleID
WHERE Rolename = "Captain"; 

-- Gibt die Anzahl an Crewmitglieder pro Schiff aus --
SELECT COUNT(Prename) FROM tSpaceship
JOIN tCrew_Spaceship ON tSpaceship.SpaceShipID=tCrew_Spaceship.SpaceshipFID
JOIN tCrew ON tCrew_Spaceship.CrewFID=tCrew.CrewID
WHERE SpaceShipID LIKE 1;

-- Gibt die Anzahl an Schiffe in der Flotte aus welche "Scrap [kg]"[Cargoname] geladen haben--
SELECT COUNT(Cargoname) FROM tSpaceship
JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
WHERE Cargoname = "Scrap [kg]";

-- Gibt die Ganze Fracht des Schiffs aus --
SELECT Cargoname, Cargoamount FROM tSpaceship
JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
WHERE SpaceShipID LIKE 1;

-- Gibt die Durchschnittliche Menge "Water [l]"[Cargoname] aus welche pro Schiff gelden ist"
SELECT AVG(Cargoamount) FROM tSpaceship
JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
WHERE Cargoname = "Water [l]";

-- Zählt das Gesamtmenge der Fracht des Schiffs --
SELECT SUM(Cargoamount) FROM tSpaceship
JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
WHERE SpaceShipID LIKE 1;

-- Gibt aus welche Muniton unter dem gewünschten Wert ist --
SELECT Ammunitionname, Ammunitionamount FROM tSpaceship
JOIN tSpaceship_Ammunition ON tSpaceship.SpaceShipID=tSpaceship_Ammunition.SpaceshipFID
JOIN tAmmunitionhold ON tSpaceship_Ammunition.AmmunitionholdFID=tAmmunitionhold.AmmunitionholdID
WHERE SpaceShipID LIKE 1 AND Equipmentname LIKE "Ballistic-Ammuniton%" AND Ammunitionamount < 20000;

-- Gibt alle Schiffe der Flotte aus welche sich an dieser Destination befinden --
SELECT Shipname FROM tFleet
JOIN tDivision ON tFleet.FleetID=tDivision.FleetFID
JOIN tSpaceship ON tDivision.DivisionID=tSpaceship.DivisionFID
JOIN tDest_Moon ON tSpaceship.DestmoonFID=tDest_Moon.DestMoonID
JOIN tDestination ON tDest_Moon.DestinationFID=tDestination.DestinationID
JOIN tMoon ON tDest_Moon.MoonFID=tMoon.MoonID
WHERE Destinationname = "Earth" AND Moonname = "Moon";

-- Gibt die Ballistischen Waffen und deren Munitionsmenge für alle Schiffe der Flotte aus --
SELECT Shipname, Equipmentname, Equipmentsize, Ammunitionname, Ammunitionamount FROM tShipequipment
JOIN tSpaceship_Shipequipment ON tShipequipment.ShipequipmentID=tSpaceship_Shipequipment.ShipequipmentFID
JOIN tSpaceship ON tSpaceship_Shipequipment.SpaceshipFID=tSpaceship.SpaceShipID
JOIN tSpaceship_Ammunition ON tSpaceship.SpaceShipID=tSpaceship_Ammunition.SpaceshipFID
JOIN tAmmunitionhold ON tSpaceship_Ammunition.AmmunitionholdFID=tAmmunitionhold.AmmunitionholdID
WHERE Equipmentname = "Gatling-Gun" AND Ammunitionname LIKE "Ballistic-Ammuniton%" OR Equipmentname = "Flair-Launcher" AND Ammunitionname LIKE "Flair%" 
ORDER BY Shipname DESC, Equipmentname DESC, Equipmentsize DESC;

-- Gibt die Schiffe aus welche weniger "Iron-Ore"[Cargoname] alls das Schiff "Pillar of Autumn"[Shipname] haben --
SELECT Shipname, Cargoamount FROM tSpaceship
JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
  WHERE Cargoname = "Iron-ore [kg]" AND Cargoamount <
     (SELECT Cargoamount FROM tSpaceship
     JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
	 JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
      WHERE Shipname = "Pillar of Autumn" AND Cargoname = "Iron-ore [kg]" )

-- Gibt alle Raumschiffe aus welche sich am gleichen Ort wie die "Nexus"[Shipname] befinden --

SELECT Shipname FROM tSpaceship
JOIN tDest_Moon ON tSpaceship.DestmoonFID=tDest_Moon.DestMoonID
WHERE DestMoonID = 
    (SELECT DestMoonID FROM tSpaceship
    JOIN tDest_Moon ON tSpaceship.DestmoonFID=tDest_Moon.DestMoonID
    WHERE Shipname = "Nexus")

-- Gibt alle Raumschiffe aus welchen sich beim gleichen Planeten und den zugehörigen Monde wie die "Pillar of Autumn"[Shipname] befinden --

SELECT Shipname, Destinationname, Moonname FROM tSpaceship
JOIN tDest_Moon ON tSpaceship.DestmoonFID=tDest_Moon.DestMoonID
JOIN tDestination ON tDest_Moon.DestinationFID=tDestination.DestinationID
JOIN tMoon ON tDest_Moon.MoonFID=tMoon.MoonID
WHERE DestinationID = 
    (SELECT DestinationID FROM tSpaceship
    JOIN tDest_Moon ON tSpaceship.DestmoonFID=tDest_Moon.DestMoonID
    JOIN tDestination ON tDest_Moon.DestinationFID=tDestination.DestinationID
    JOIN tMoon ON tDest_Moon.MoonFID=tMoon.MoonID
    WHERE Shipname = "Pillar of Autumn")

-- Gibt alle Raumschiffe aus welche weniger "Iron-ore [kg]" als der Durchschnitt aller Raumschiffe geladen haben --

SELECT Shipname, Cargoamount FROM tSpaceship
JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
WHERE Cargoname = "Iron-ore [kg]" AND Cargoamount <
    (SELECT AVG(Cargoamount) FROM tSpaceship
    JOIN tSpaceship_Cargo ON tSpaceship.SpaceShipID=tSpaceship_Cargo.SpaceshipFID
    JOIN tCargohold ON tSpaceship_Cargo.CargoholdFID=tCargohold.CargoholdID
    WHERE Shipname LIKE "%" AND Cargoname = "Iron-ore [kg]")

-- Gibt alle Crewmitglieder mit all ihren Persönlichen Daten eines jeweiligen Raumschschiffs auf --

SELECT Prename, Lastname, Birthday, tCrewrole.rolename FROM tSpaceship
JOIN tCrew_Spaceship ON tSpaceship.SpaceShipID=tCrew_Spaceship.SpaceshipFID
JOIN tCrew ON tCrew_Spaceship.CrewFID=tCrew.CrewID
JOIN tCrewrole ON tCrew.CrewroleFID=tCrewrole.CrewroleID
WHERE Shipname = "Pillar of Autumn" ORDER BY Lastname ASC;

-- Gibt alle Destinationen aus --

SELECT Destinationname, Moonname FROM tDest_Moon
JOIN tDestination ON tDest_Moon.DivisionFID=tDestination.DestinationID
JOIN tMoon ON tDest_Moon.MoonFID=tMoon.MoonID
WHERE DestMoonID LIKE "%";