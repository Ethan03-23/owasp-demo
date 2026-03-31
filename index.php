<?php
require_once 'includes/header.php';
?>

<section class="card">
    <h1>OWASP Top 10 Demonstration Project</h1>
    <p>
        This is a local web application being developed for a Security Engineering Project.
        The purpose of the project is to demonstrate selected OWASP Top 10 vulnerabilities
        in a safe, local-only environment.
    </p>

    <h2>Selected Vulnerabilities</h2>
    <ul>
        <li>Broken Access Control</li>
        <li>Injection</li>
        <li>Identification and Authentication Failures</li>
        <li>Security Misconfiguration</li>
    </ul>

    <p>
        The current project contains a working authentication system, role-based structure,
        and the first vulnerable modules for Broken Access Control and SQL Injection.
    </p>
</section>

<section class="card">
    <h2>Current Status</h2>
    <p>
        The application now includes the secure baseline pages as well as the first
        vulnerable modules used for security demonstration and testing.
    </p>
</section>

<?php require_once 'includes/footer.php'; ?>