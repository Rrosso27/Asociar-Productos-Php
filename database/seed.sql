INSERT INTO productos (nombre, descripcion, precio, stock, estado) VALUES 
('Laptop Dell', 'Laptop de alto rendimiento', 1500.00, 10, 1),
('Monitor LG', 'Monitor Full HD de 24 pulgadas', 200.00, 25, 1);

INSERT INTO grupos (nombre, descripcion) VALUES 
('Electrónica', 'Productos electrónicos'),
('Oficina', 'Material de oficina');

-- Asignación de productos a grupos
INSERT INTO producto_grupo (producto_id, grupo_id) VALUES (1, 1), (2, 2);
