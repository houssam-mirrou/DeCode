BEGIN;

DROP TABLE IF EXISTS evaluation_competences CASCADE;
DROP TABLE IF EXISTS evaluation CASCADE;
DROP TABLE IF EXISTS livrable CASCADE;
DROP TABLE IF EXISTS brief_competence CASCADE;
DROP TABLE IF EXISTS brief_teacher CASCADE;
DROP TABLE IF EXISTS brief CASCADE;
DROP TABLE IF EXISTS competence CASCADE;
DROP TABLE IF EXISTS sprint CASCADE;
DROP TABLE IF EXISTS teachers_in_class CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS class CASCADE;

CREATE TABLE class (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    school_year VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    role VARCHAR(20) DEFAULT 'student' NOT NULL CHECK (role IN ('student', 'teacher', 'admin')),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    class_id INT,
    CONSTRAINT fk_user_class FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE SET NULL
);

CREATE TABLE teachers_in_class (
    id SERIAL PRIMARY KEY,
    class_id INT NOT NULL,
    teacher_id INT NOT NULL,
    CONSTRAINT fk_teachers_in_class_class_id FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE,
    CONSTRAINT fk_teachers_in_class_teacher_id FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE sprint (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    class_id INT NOT NULL,
    CONSTRAINT fk_sprint_class FOREIGN KEY (class_id) REFERENCES class(id) ON DELETE CASCADE
);

CREATE TABLE brief (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    date_remise TIMESTAMP,
    type VARCHAR(20) DEFAULT 'individuel' NOT NULL CHECK (type IN ('individuel', 'collectif')),
    sprint_id INT NOT NULL,
    CONSTRAINT fk_brief_sprint FOREIGN KEY (sprint_id) REFERENCES sprint(id) ON DELETE CASCADE
);

CREATE TABLE brief_teacher (
    id SERIAL PRIMARY KEY,
    teacher_id INT,
    brief_id INT,
    CONSTRAINT fk_brief_teacher_teacher_id FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_brief_teacher_brief_id FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE
);

CREATE TABLE competence (
    id SERIAL PRIMARY KEY,
    code VARCHAR(10) NOT NULL,
    libelle VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE brief_competence (
    id SERIAL PRIMARY KEY,
    brief_id INT NOT NULL,
    competence_id INT NOT NULL,
    level VARCHAR(20) NOT NULL CHECK (level IN ('IMITER', 'S_ADAPTER', 'TRANSPOSER')),
    CONSTRAINT fk_brief_competence_brief_id FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE,
    CONSTRAINT fk_brief_competence_competence_id FOREIGN KEY (competence_id) REFERENCES competence(id) ON DELETE CASCADE
);

CREATE TABLE evaluation (
    id SERIAL PRIMARY KEY,
    student_id INT NOT NULL,
    brief_id INT NOT NULL,
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    level VARCHAR(20) NOT NULL CHECK (level IN ('IMITER', 'S_ADAPTER', 'TRANSPOSER')),
    review VARCHAR(20) NOT NULL CHECK (review IN ('bad', 'good', 'excellent')),
    CONSTRAINT fk_eval_student FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_eval_brief FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE
);

CREATE TABLE evaluation_competences (
    id SERIAL PRIMARY KEY,
    evaluation_id INT NOT NULL,
    competence_id INT NOT NULL,
    level VARCHAR(20) NOT NULL CHECK (level IN ('IMITER', 'S_ADAPTER', 'TRANSPOSER')),
    CONSTRAINT fk_eval_comp_eval FOREIGN KEY (evaluation_id) REFERENCES evaluation(id) ON DELETE CASCADE,
    CONSTRAINT fk_eval_competence FOREIGN KEY (competence_id) REFERENCES competence(id) ON DELETE CASCADE
);

CREATE TABLE livrable (
    id SERIAL PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    comment VARCHAR(255),
    date_submitted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    student_id INT NOT NULL,
    brief_id INT NOT NULL,
    CONSTRAINT fk_livrable_student FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_livrable_brief FOREIGN KEY (brief_id) REFERENCES brief(id) ON DELETE CASCADE
);

INSERT INTO class (id, name, school_year) VALUES
    (1, 'DEV101', '2025-2026'),
    (2, 'DEV102', '2025-2026');

INSERT INTO users (id, first_name, last_name, email, password, role, class_id) VALUES
    (1, 'Admin', 'DeCode', 'admin@decode.test', '$2y$10$T/UXsEPGBiytWNIyOKodXO/V38mW2y/xMbQJdlUI5hIy5GKk2Jxoq', 'admin', NULL),
    (2, 'Sara', 'El Amrani', 'teacher@decode.test', '$2y$10$T/UXsEPGBiytWNIyOKodXO/V38mW2y/xMbQJdlUI5hIy5GKk2Jxoq', 'teacher', NULL),
    (3, 'Omar', 'Zerouali', 'teacher2@decode.test', '$2y$10$T/UXsEPGBiytWNIyOKodXO/V38mW2y/xMbQJdlUI5hIy5GKk2Jxoq', 'teacher', NULL),
    (4, 'Yasmine', 'Bennani', 'student@decode.test', '$2y$10$T/UXsEPGBiytWNIyOKodXO/V38mW2y/xMbQJdlUI5hIy5GKk2Jxoq', 'student', 1),
    (5, 'Mehdi', 'Alaoui', 'student2@decode.test', '$2y$10$T/UXsEPGBiytWNIyOKodXO/V38mW2y/xMbQJdlUI5hIy5GKk2Jxoq', 'student', 1),
    (6, 'Nour', 'Tazi', 'student3@decode.test', '$2y$10$T/UXsEPGBiytWNIyOKodXO/V38mW2y/xMbQJdlUI5hIy5GKk2Jxoq', 'student', 2);

INSERT INTO teachers_in_class (id, class_id, teacher_id) VALUES
    (1, 1, 2),
    (2, 2, 3);

INSERT INTO sprint (id, name, start_date, end_date, class_id) VALUES
    (1, 'Sprint 1 - PHP Foundations', '2026-01-06', '2026-01-31', 1),
    (2, 'Sprint 2 - MVC and Database', '2026-02-03', '2026-02-28', 1),
    (3, 'Sprint 1 - Web Basics', '2026-01-06', '2026-01-31', 2);

INSERT INTO brief (id, title, description, date_remise, type, sprint_id) VALUES
    (1, 'Portfolio PHP', 'Build a small PHP portfolio with reusable views and clean routing.', '2026-01-24 18:00:00', 'individuel', 1),
    (2, 'Learning Management CRUD', 'Create CRUD screens for users, classes, sprints, and competences.', '2026-02-21 18:00:00', 'collectif', 2),
    (3, 'Responsive Landing Page', 'Create a responsive landing page using semantic HTML and CSS.', '2026-01-25 18:00:00', 'individuel', 3);

INSERT INTO brief_teacher (id, teacher_id, brief_id) VALUES
    (1, 2, 1),
    (2, 2, 2),
    (3, 3, 3);

INSERT INTO competence (id, code, libelle, description) VALUES
    (1, 'C1', 'Maquetter une application', 'Create wireframes and define the application structure.'),
    (2, 'C2', 'Developper une interface', 'Build responsive user interfaces with HTML, CSS, and PHP views.'),
    (3, 'C3', 'Developper la partie back-end', 'Implement server-side routes, controllers, and business logic.'),
    (4, 'C4', 'Creer une base de donnees', 'Design and query a relational database.'),
    (5, 'C5', 'Gerer un projet', 'Use version control and organize project delivery.');

INSERT INTO brief_competence (id, brief_id, competence_id, level) VALUES
    (1, 1, 1, 'IMITER'),
    (2, 1, 2, 'S_ADAPTER'),
    (3, 2, 3, 'S_ADAPTER'),
    (4, 2, 4, 'TRANSPOSER'),
    (5, 2, 5, 'S_ADAPTER'),
    (6, 3, 1, 'IMITER'),
    (7, 3, 2, 'IMITER');

INSERT INTO livrable (id, url, comment, date_submitted, student_id, brief_id) VALUES
    (1, 'https://github.com/decode/student-portfolio', 'Initial version with routes and pages.', '2026-01-22 15:30:00', 4, 1),
    (2, 'https://github.com/decode/mehdi-portfolio', 'Portfolio ready for review.', '2026-01-23 10:15:00', 5, 1),
    (3, 'https://github.com/decode/student-crud', 'CRUD screens and database integration.', '2026-02-20 17:10:00', 4, 2);

INSERT INTO evaluation (id, student_id, brief_id, comment, created_at, level, review) VALUES
    (1, 4, 1, 'Good structure and clean template usage.', '2026-01-25 09:00:00', 'S_ADAPTER', 'good'),
    (2, 5, 1, 'Excellent polish and responsive behavior.', '2026-01-25 09:30:00', 'TRANSPOSER', 'excellent');

INSERT INTO evaluation_competences (id, evaluation_id, competence_id, level) VALUES
    (1, 1, 1, 'S_ADAPTER'),
    (2, 1, 2, 'S_ADAPTER'),
    (3, 2, 1, 'TRANSPOSER'),
    (4, 2, 2, 'TRANSPOSER');

SELECT setval(pg_get_serial_sequence('class', 'id'), (SELECT MAX(id) FROM class));
SELECT setval(pg_get_serial_sequence('users', 'id'), (SELECT MAX(id) FROM users));
SELECT setval(pg_get_serial_sequence('teachers_in_class', 'id'), (SELECT MAX(id) FROM teachers_in_class));
SELECT setval(pg_get_serial_sequence('sprint', 'id'), (SELECT MAX(id) FROM sprint));
SELECT setval(pg_get_serial_sequence('brief', 'id'), (SELECT MAX(id) FROM brief));
SELECT setval(pg_get_serial_sequence('brief_teacher', 'id'), (SELECT MAX(id) FROM brief_teacher));
SELECT setval(pg_get_serial_sequence('competence', 'id'), (SELECT MAX(id) FROM competence));
SELECT setval(pg_get_serial_sequence('brief_competence', 'id'), (SELECT MAX(id) FROM brief_competence));
SELECT setval(pg_get_serial_sequence('livrable', 'id'), (SELECT MAX(id) FROM livrable));
SELECT setval(pg_get_serial_sequence('evaluation', 'id'), (SELECT MAX(id) FROM evaluation));
SELECT setval(pg_get_serial_sequence('evaluation_competences', 'id'), (SELECT MAX(id) FROM evaluation_competences));

COMMIT;
