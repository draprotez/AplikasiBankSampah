<?php

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

