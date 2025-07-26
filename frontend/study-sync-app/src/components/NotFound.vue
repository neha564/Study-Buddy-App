<template>
  <div class="not-found">
    <div class="content">
      <h1 class="error-code">404</h1>
      <h2>Oops! The page you're looking for doesn't exist.</h2>
      <p>
        It seems the page you are trying to access is not available or you have
        typed the wrong URL.
      </p>
      <router-link to="/" class="go-home-button">GO BACK TO HOME</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "NotFound",
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

.not-found {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #fff;
  text-align: center;
  font-family: "Poppins", sans-serif;
}

.content {
  max-width: 500px;
  width: 100%;
  background-color: #fff;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  font-family: "Poppins", sans-serif;
}

.error-code {
  font-size: 6em;
  color: #e74c3c; /* Red color for the error code */
  margin: 0;
  font-family: "Poppins", sans-serif;
}

h2 {
  font-size: 1.8em;
  margin: 20px 0;
  color: #333;
}

p {
  font-size: 1.2em;
  color: #555;
  margin: 20px 0;
}

.go-home-button {
  display: inline-block;
  background-color: #3498db; /* Blue background for the button */
  color: white;
  padding: 12px 25px;
  border-radius: 30px;
  font-size: 1.2em;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.go-home-button:hover {
  background-color: #2980b9; /* Darker blue on hover */
  transform: translateY(-2px);
  transition: transform 0.2s ease;
}
</style>
