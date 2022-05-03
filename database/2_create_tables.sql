DROP TABLE IF EXISTS filmek;
DROP TABLE IF EXISTS kategoria;
DROP TABLE IF EXISTS sorozatok;
DROP TABLE IF EXISTS resz;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS korosztaly;


CREATE TABLE filmek (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
cim VARCHAR(255) NOT NULL,
hossz INT NOT NULL,
kategoria INT NOT NULL,
korosztaly INT NOT NULL,
borito VARCHAR NOT NULL);

CREATE TABLE kategoria (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
name VARCHAR(255) NOT NULL);

CREATE TABLE sorozatok (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
evad INT NOT NULL,
resz INT NOT NULL,
cim VARCHAR(255) NOT NULL,
kategoria INT NOT NULL,
korosztaly INT NOT NULL,
borito VARCHAR NOT NULL);

CREATE TABLE resz (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
evadSzam INT NOT NULL,
reszSzam INT NOT NULL,
cim INT NOT NULL,
hossz INT NOT NULL);

CREATE TABLE user (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
username INT NOT NULL,
email INT NOT NULL,
password INT NOT NULL,
lattamFilm INT NOT NULL,
lattamResz INT NOT NULL,
profilkep VARCHAR NOT NULL);

CREATE TABLE korosztaly (
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
tol INT NOT NULL,
nev VARCHAR(255) NOT NULL);

ALTER TABLE filmek ADD CONSTRAINT filmek_kategoria_kategoria_id FOREIGN KEY (kategoria) REFERENCES kategoria(id);
ALTER TABLE filmek ADD CONSTRAINT filmek_korosztaly_korosztaly_id FOREIGN KEY (korosztaly) REFERENCES korosztaly(id);
ALTER TABLE sorozatok ADD CONSTRAINT sorozatok_kategoria_kategoria_id FOREIGN KEY (kategoria) REFERENCES kategoria(id);
ALTER TABLE sorozatok ADD CONSTRAINT sorozatok_korosztaly_korosztaly_id FOREIGN KEY (korosztaly) REFERENCES korosztaly(id);
ALTER TABLE resz ADD CONSTRAINT resz_evadSzam_sorozatok_evad FOREIGN KEY (evadSzam) REFERENCES sorozatok(evad);
ALTER TABLE resz ADD CONSTRAINT resz_reszSzam_sorozatok_resz FOREIGN KEY (reszSzam) REFERENCES sorozatok(resz);
ALTER TABLE user ADD CONSTRAINT user_lattamFilm_filmek_id FOREIGN KEY (lattamFilm) REFERENCES filmek(id);
ALTER TABLE user ADD CONSTRAINT user_lattamResz_resz_id FOREIGN KEY (lattamResz) REFERENCES resz(id);