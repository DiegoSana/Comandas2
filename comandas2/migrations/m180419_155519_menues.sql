/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Productos',NULL,'/productos/productos/index',1,NULL),(3,'Cetegorias',NULL,'/productos/categorias/index',2,NULL),(4,'Mesas',NULL,'/mesas/mesas/index',3,NULL),(5,'Administrador',NULL,NULL,NULL,NULL),(6,'Usuarios',5,'/admin/user/index',NULL,NULL),(7,'Asignaciones',5,'/admin/assignment/index',NULL,NULL),(8,'Roles',5,'/admin/role/index',NULL,NULL),(9,'Permisos',5,'/admin/permission/index',NULL,NULL),(10,'Reglas',5,'/admin/rule/index',NULL,NULL),(11,'Menúes',5,'/admin/menu/index',NULL,NULL),(12,'Debug',5,'/debug/default/index',NULL,NULL),(13,'Pedidos',NULL,'/pedidos/pedidos/index',4,NULL),(14,'Aplicaciones',5,'/aplicacion/aplicacion/index',NULL,NULL),(15,'Empresas',5,'/aplicacion/empresa/index',NULL,NULL),(16,'Cocina',NULL,'/pedidos/pedidos-has-productos',5,NULL),(17,'Rutas',5,'/admin/route/index',NULL,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;