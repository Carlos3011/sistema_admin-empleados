-- Crear la base de datos
CREATE DATABASE sistema_asistencia;

-- Usar la base de datos creada
USE sistema_asistencia;

-- Tabla: roles
CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    rol VARCHAR(50) NOT NULL
);

-- Tabla: empleados
CREATE TABLE empleados (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Campo para contraseñas (hashed)
    activo TINYINT(1) NOT NULL DEFAULT 1, -- Indica si el usuario está activo (1) o no (0)
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

-- Tabla: turnos_laborales
CREATE TABLE turnos_laborales (
    id_turno INT AUTO_INCREMENT PRIMARY KEY,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL
);

-- Tabla: registros_asistencia
CREATE TABLE registros_asistencia (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    id_empleado INT NOT NULL,
    tipo_evento ENUM('entrada', 'salida_a_comer', 'regreso_de_comer', 'salida_final') NOT NULL,
    fecha_hora DATETIME NOT NULL,
    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
);

-- Tabla: permisos
CREATE TABLE permisos (
    id_permiso INT AUTO_INCREMENT PRIMARY KEY,
    id_empleado INT NOT NULL,
    tipo_permiso VARCHAR(100) NOT NULL,
    fecha_inicio DATETIME NOT NULL,
    fecha_fin DATETIME NOT NULL,
    FOREIGN KEY (id_empleado) REFERENCES empleados(id_empleado)
);
