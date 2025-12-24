<?php
class UserModel
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function login(string $email, string $password)
    {
        // Fetch user by email and verify password securely. This allows
        // support for hashed passwords (recommended) while keeping a
        // backward-compatible fallback for plain-text passwords.
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            return false;
        }

        // If passwords are stored hashed (recommended), use password_verify.
        if (isset($user['password']) && password_verify($password, $user['password'])) {
            return $user;
        }

        // Backward compatibility: allow direct match for plaintext (not recommended).
        if (isset($user['password']) && $user['password'] === $password) {
            return $user;
        }

        return false;
    }

    /**
     * Get user by id
     *
     * @param int $id
     * @return array|false
     */
    public function findById(int $id)
    {
        $sql = "SELECT * FROM users WHERE user_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
