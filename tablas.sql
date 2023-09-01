-- create_institutions_table.php
CREATE TABLE `institutions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  -- Agrega aquí los campos adicionales según tus necesidades.
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- create_departments_table.php
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `institution_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned UNIQUE NOT NULL,
  -- Agrega aquí los campos adicionales según tus necesidades.
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  CONSTRAINT `departments_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`),
  CONSTRAINT `departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- create_users_table.php
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  -- Agrega aquí los campos adicionales según tus necesidades.
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- create_permissions_table.php
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL UNIQUE,
  `guard_name` varchar(255) NOT NULL,
  -- Agrega aquí los campos adicionales según tus necesidades.
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- create_roles_table.php
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL UNIQUE,
  `guard_name` varchar(255) NOT NULL,
  -- Agrega aquí los campos adicionales según tus necesidades.
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
