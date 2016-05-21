<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="dark-panel-center">
        <ul>
            <li>
                <h1>Consecte oura</h1>
            </li>
            <li>
                <p>Mauris molestie iaculis tellus ino.</p>
            </li>
            <li class="username">
                <label for="email" class="sr-only" hidden>Email address</label>
                <input id="email" name="email" type="text" class="login-input" placeholder="Email address" required autofocus>
            </li>
            <li class="password">
                <label for="password" class="sr-only" hidden>Password</label>
                <input id="password" name="password" type="password" class="login-input" placeholder="Password" required>
            </li>
            <li class="button">
                <input type="submit" class="button">
            </li>
        </ul>
    </div>

</form>
