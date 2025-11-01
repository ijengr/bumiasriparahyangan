-- Database Optimization Script
-- Generated on: 2025-11-01 17:46:21

-- Optimize all tables
OPTIMIZE TABLE `sessions`;
OPTIMIZE TABLE `settings`;
OPTIMIZE TABLE `gallery_images`;
OPTIMIZE TABLE `migrations`;
OPTIMIZE TABLE `units`;
OPTIMIZE TABLE `messages`;
OPTIMIZE TABLE `facilities`;
OPTIMIZE TABLE `users`;

-- Analyze tables for better query optimization
ANALYZE TABLE `sessions`;
ANALYZE TABLE `settings`;
ANALYZE TABLE `gallery_images`;
ANALYZE TABLE `migrations`;
ANALYZE TABLE `units`;
ANALYZE TABLE `messages`;
ANALYZE TABLE `facilities`;
ANALYZE TABLE `users`;
