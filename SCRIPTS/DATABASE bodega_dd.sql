CREATE DATABASE bodega_db;
USE bodega_db;

CREATE TABLE Permisos (
    idPermiso INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    fechaAlta DATETIME NOT NULL
);

CREATE TABLE Rol (
    idRol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    estatus INT NOT NULL
);

CREATE TABLE PermisoRoles (
    idRol INT NOT NULL,
    idPermiso INT NOT NULL,
    fechaMov DATETIME NOT NULL,
    CONSTRAINT FK_PermisoRoles_Rol FOREIGN KEY (idRol) REFERENCES Rol(idRol),
    CONSTRAINT FK_PermisoRoles_Permisos FOREIGN KEY (idPermiso) REFERENCES Permisos(idPermiso)
);

CREATE TABLE Usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    contrasena VARCHAR(25) NOT NULL,
    idRol INT NOT NULL,
    estatus INT NOT NULL,
    CONSTRAINT FK_Usuario_Rol FOREIGN KEY (idRol) REFERENCES Rol(idRol)
);

CREATE TABLE Inventario (
    idInventario INT AUTO_INCREMENT PRIMARY KEY,
    cantidad INT NOT NULL,
    fechaMov DATETIME NOT NULL,
    idUserMov INT NOT NULL,
    CONSTRAINT FK_Inventario_Usuario FOREIGN KEY (idUserMov) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Productos (
    idProducto INT NOT NULL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    estatus INT NOT NULL,
    precio DECIMAL(18,2) NOT NULL,
    idInventario INT NOT NULL,
    fechaMov DATETIME NOT NULL,
    idUserMov INT NOT NULL,
    CONSTRAINT FK_Productos_Inventario FOREIGN KEY (idInventario) REFERENCES Inventario(idInventario),
    CONSTRAINT FK_Productos_Usuario FOREIGN KEY (idUserMov) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Historial (
    idHistorial INT AUTO_INCREMENT PRIMARY KEY,
    idProducto INT NOT NULL,
    cantidad INT NOT NULL,
    movimiento INT NOT NULL,
    fechaMov DATETIME NOT NULL,
    idUserMov INT NOT NULL,
    CONSTRAINT FK_Historial_Productos FOREIGN KEY (idProducto) REFERENCES Productos(idProducto),
    CONSTRAINT FK_Historial_Usuario FOREIGN KEY (idUserMov) REFERENCES Usuario(idUsuario)
);