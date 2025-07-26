<template>
  <v-container class="register-container">
    <v-row align="center" justify="center">
      <v-col cols="12" md="6" lg="4">
        <v-card class="pa-5 register-card" elevation="3">
          <v-card-title class="text-center">
            <h2>Register</h2>
          </v-card-title>
          <v-card-text>
            <v-form @submit.prevent="submitRegister">
              <v-text-field
                label="Name"
                v-model="name"
                prepend-icon="mdi-account"
                outlined
                dense
                required
              />
              <v-text-field
                label="Email"
                v-model="email"
                prepend-icon="mdi-email"
                outlined
                dense
                required
              />
              <v-text-field
                label="Password"
                v-model="password"
                :type="showPassword ? 'text' : 'password'"
                prepend-icon="mdi-lock"
                outlined
                dense
                required
                :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="togglePasswordVisibility"
              />
              <v-text-field
                label="Confirm Password"
                v-model="confirmPassword"
                :type="showConfirmPassword ? 'text' : 'password'"
                prepend-icon="mdi-lock"
                outlined
                dense
                required
                :append-icon="showConfirmPassword ? 'mdi-eye-off' : 'mdi-eye'"
                @click:append="toggleConfirmPasswordVisibility"
              />
              <v-btn
                color="primary"
                class="mt-4 register-btn"
                block
                type="submit"
                elevation="2"
                :loading="isLoading"
                :disabled="isLoading"
                style="font-size: 16px"
              >
                <template v-if="!isLoading">Register</template>
                <template v-else>
                  <v-progress-circular
                    indeterminate
                    color="white"
                    size="20"
                    class="mr-2"
                  />
                  Loading...
                </template>
              </v-btn>
              <p v-if="errorMessage" class="error-message">
                {{ errorMessage }}
              </p>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      confirmPassword: "",
      showPassword: false, // State for password visibility toggle
      showConfirmPassword: false, // State for confirm password visibility toggle
      isLoading: false, // Loading state for register button
      errorMessage: null,
    };
  },
  methods: {
    ...mapActions(["register"]),
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    toggleConfirmPasswordVisibility() {
      this.showConfirmPassword = !this.showConfirmPassword;
    },
    async submitRegister() {
      if (this.password !== this.confirmPassword) {
        this.errorMessage = "Passwords do not match.";
        return;
      }
      this.isLoading = true; // Set loading state
      this.errorMessage = null; // Clear previous error
      try {
        // Send registration request (does not log the user in)
        await this.register({
          name: this.name,
          email: this.email,
          password: this.password,
        });

        // After successful registration, navigate to the login page
        this.$router.push("/login");
      } catch (error) {
        // Handle error: Display the message from the backend
        this.errorMessage =
          error.response && error.response.data && error.response.data.message
            ? error.response.data.message
            : "Registration failed. Please try again.";
        console.error("Error during registration:", error);
      } finally {
        this.isLoading = false; // Reset loading state
      }
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

.register-container {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 80vh;
}

.register-card {
  font-family: "Poppins", sans-serif;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  transition:
    transform 0.2s ease,
    box-shadow 0.2s ease;
}

.register-card:hover {
  transform: translateY(-4px);
  box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.2);
}

h2 {
  font-weight: 600;
  color: #3a3a9e;
  margin-bottom: 16px;
}

.v-card-title {
  font-family: "Poppins", sans-serif;
  color: #424242;
}

.register-btn {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  transition: transform 0.2s ease;
}

.register-btn:hover {
  background-color: #3949ab;
  transform: translateY(-2px);
}

.error-message {
  color: #e53935;
  font-family: "Poppins", sans-serif;
  font-size: 0.9em;
  margin-top: 16px;
  text-align: center;
}
</style>
