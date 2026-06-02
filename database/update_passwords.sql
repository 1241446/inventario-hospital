-- Actualizar passwords para bcrypt (password_hash PHP)
USE `db1241446`;

UPDATE Utilizador SET password = '$2y$10$e017jXf6fLDEBpRbS8RxeOO5XizMfRGwJbqUQV9DaRDwgmg.kpsQ.' WHERE email = 'admin@medcontrol.pt';
UPDATE Utilizador SET password = '$2y$10$RoSyVl0pgarYw5PUmwM1e.CzpltKZuyVyV0aSZxVSiY90ZRxNl6zC' WHERE email = 'carlos@medcontrol.pt';
UPDATE Utilizador SET password = '$2y$10$ceZzqLY69PjVv50PZ9C0E.t/wiY7mJIes2ugyduwEhlfFApfgj/0u' WHERE email = 'joana@medcontrol.pt';
UPDATE Utilizador SET password = '$2y$10$hHgMEd78QNEYCTdGapLZlO/yt6rDuYwWwLVxx/LlPL2E7sxgrvbMi' WHERE email = 'rui@medcontrol.pt';

SELECT email, LEFT(password,7) AS prefix, LENGTH(password) AS len FROM Utilizador;
