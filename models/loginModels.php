<?php
/**
 * Login model
 * Provides functions to fetch admin and user records for authentication
 */

/**
 * Get admin by username
 * @param mysqli $conn
 * @param string $username
 * @return array|null
 */
function getAdminByUsername($conn, $username)
{
	$sql = "SELECT * FROM admin WHERE username = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	if (!$stmt) return null;
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->num_rows ? $result->fetch_assoc() : null;
	$stmt->close();
	return $row;
}

/**
 * Get user by username or email
 * @param mysqli $conn
 * @param string $login (username or email)
 * @return array|null
 */
function getUserByLogin($conn, $login)
{
	$sql = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
	$stmt = $conn->prepare($sql);
	if (!$stmt) return null;
	$stmt->bind_param('ss', $login, $login);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->num_rows ? $result->fetch_assoc() : null;
	$stmt->close();
	return $row;
}

