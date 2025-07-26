<template>
  <v-app>
    <!-- Navbar -->
    <v-app-bar color="indigo-darken-3" elevate-on-scroll app fixed>
      <v-container>
        <v-row class="d-flex align-center ma-0 pa-0" align="center">
          <!-- Logo and Title -->
          <v-col class="d-flex align-center">
            <v-icon
              class="logo-icon mr-2"
              style="font-family: 'Poppins', sans-serif; font-size: 24px;"
              icon="mdi-school"
            ></v-icon>
            <v-app-bar-title
              class="title"
              style="font-family: 'Poppins', sans-serif; font-size: 24px;"
              @click="goHome"
            >
              StudySync
            </v-app-bar-title>
          </v-col>

          <!-- Desktop Navigation Links -->
          <v-col class="d-none d-md-flex justify-end align-center">
            <v-btn
              variant="text"
              :to="{ path: '/' }"
              class="nav-btn"
              :class="{ 'active-link': $route.path === '/' }"
              style="font-family: 'Poppins', sans-serif; font-size: 16px;"
            >
              <v-icon class="nav-icon" icon="mdi-home"></v-icon> Home
            </v-btn>
            <v-btn
              variant="text"
              :to="{ path: '/profile' }"
              class="nav-btn"
              :class="{ 'active-link': $route.path === '/profile' }"
              style="font-family: 'Poppins', sans-serif; font-size: 16px;"
            >
              <v-icon class="nav-icon" icon="mdi-account"></v-icon> Profile
            </v-btn>
            <v-btn
              variant="text"
              :to="{ path: '/register' }"
              class="nav-btn"
              :class="{ 'active-link': $route.path === '/register' }"
              style="font-family: 'Poppins', sans-serif; font-size: 16px;"
            >
              <v-icon class="nav-icon" icon="mdi-account-plus"></v-icon> Register
            </v-btn>
            <v-btn
              v-if="!isAuthenticated"
              variant="text"
              :to="{ path: '/login' }"
              class="nav-btn"
              :class="{ 'active-link': $route.path === '/login' }"
              style="font-family: 'Poppins', sans-serif; font-size: 16px;"
            >
              <v-icon class="nav-icon" icon="mdi-login"></v-icon> Login
            </v-btn>
            <v-btn
              v-if="isAuthenticated"
              variant="text"
              @click="logout"
              class="nav-btn"
              style="font-family: 'Poppins', sans-serif; font-size: 16px; color: red;"
            >
              <v-icon class="nav-icon" icon="mdi-logout"></v-icon> Logout
            </v-btn>
          </v-col>

          <!-- Mobile Menu Icon -->
          <v-col class="d-flex d-md-none justify-end">
            <v-app-bar-nav-icon
              class="mobile-menu-icon"
              @click="drawer = !drawer"
            />
          </v-col>
        </v-row>
      </v-container>
    </v-app-bar>

    <!-- Mobile Drawer for Navigation -->
    <v-navigation-drawer
      v-model="drawer"
      temporary
      location="left"
      width="250"
      class="indigo-darken-3"
      scrim
    >
      <v-list density="compact">
        <v-list-item
          :to="{ path: '/' }"
          @click="closeDrawer"
          class="mobile-nav-item"
        >
          <template #prepend>
            <v-icon class="mobile-nav-icon" icon="mdi-home"></v-icon>
          </template>
          <v-list-item-title
            style="font-family: 'Poppins', sans-serif; font-size: 16px;"
          >Home</v-list-item-title>
        </v-list-item>

        <v-list-item
          :to="{ path: '/profile' }"
          @click="closeDrawer"
          class="mobile-nav-item"
        >
          <template #prepend>
            <v-icon class="mobile-nav-icon" icon="mdi-account"></v-icon>
          </template>
          <v-list-item-title
            style="font-family: 'Poppins', sans-serif; font-size: 16px;"
          >Profile</v-list-item-title>
        </v-list-item>

        <v-list-item
          :to="{ path: '/register' }"
          @click="closeDrawer"
          class="mobile-nav-item"
        >
          <template #prepend>
            <v-icon class="mobile-nav-icon" icon="mdi-account-plus"></v-icon>
          </template>
          <v-list-item-title
            style="font-family: 'Poppins', sans-serif; font-size: 16px;"
          >Register</v-list-item-title>
        </v-list-item>

        <v-list-item
          v-if="!isAuthenticated"
          :to="{ path: '/login' }"
          @click="closeDrawer"
          class="mobile-nav-item"
        >
          <template #prepend>
            <v-icon class="mobile-nav-icon" icon="mdi-login"></v-icon>
          </template>
          <v-list-item-title
            style="font-family: 'Poppins', sans-serif; font-size: 16px;"
          >Login</v-list-item-title>
        </v-list-item>

        <v-list-item
          v-if="isAuthenticated"
          @click="logoutAndCloseDrawer"
          class="mobile-nav-item"
          style="color: red"
        >
          <template #prepend>
            <v-icon class="mobile-nav-icon" icon="mdi-logout" style="color: red;"></v-icon>
          </template>
          <v-list-item-title
            style="font-family: 'Poppins', sans-serif; font-size: 16px;"
          >Logout</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <!-- Main Content Area -->
    <v-main class="main-content">
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import axios from "axios";

export default {
  data() {
    return {
      drawer: false,
      tokenCheckInterval: null,
    };
  },
  computed: {
    ...mapGetters(["isAuthenticated"]),
  },
  methods: {
    goHome() {
      this.$router.push("/");
    },
    ...mapActions(["logout"]),
    closeDrawer() {
      this.drawer = false;
    },
    logoutAndCloseDrawer() {
      this.logout();
      this.drawer = false;
    },
    async fetchUserProfile() {
      const token = localStorage.getItem("token");
      if (!token) {
        this.forceLogout();
        return;
      }
      try {
        await axios.get(
          "https://studysync-study-buddy-app.onrender.com/api/profile",
          {
            headers: { Authorization: `Bearer ${token}` },
          }
        );
      } catch (error) {
        this.forceLogout();
      }
    },
    forceLogout() {
      localStorage.removeItem("token");
      this.logout();
      if (this.$route.path !== "/login" && (this.$route.path === "/home" || this.$route.path === "/profile")) {
        this.$router.replace("/login");
      }
    },
  },
  created() {
    this.fetchUserProfile();
    this.tokenCheckInterval = setInterval(this.fetchUserProfile, 5000);
  },
  beforeUnmount() {
    if (this.tokenCheckInterval) {
      clearInterval(this.tokenCheckInterval);
    }
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

.title:hover {
  color: #ffeb3b;
  cursor: pointer;
}
.v-app-bar {
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
  transition: background-color 0.3s ease;
  width: 100%;
}
.v-app-bar:hover {
  background-color: #3a3a9e;
}
.logo-icon {
  font-size: 28px;
  color: #ffeb3b;
  margin-right: 12px;
}
.nav-btn {
  color: white;
  font-weight: 500;
  text-transform: uppercase;
  margin: 0 10px;
  padding: 6px 10px;
  font-family: "Poppins", sans-serif;
  transition: color 0.3s ease, transform 0.2s ease;
  display: flex;
  align-items: center;
}
.nav-icon {
  margin-right: 10px;
}
.nav-btn:hover {
  color: #fff;
  background-color: rgba(255, 255, 255, 0.1);
  transform: translateY(-2px);
}
.active-link {
  color: #ffeb3b !important;
  border-bottom: 2px solid #ffeb3b;
  border-radius: 2px;
}
.mobile-nav-item {
  display: flex;
  align-items: center;
  transition: background-color 0.3s ease;
}
.mobile-nav-item:hover {
  background-color: rgba(255, 255, 255, 0.1);
}
.mobile-nav-icon {
  margin-right: 10px;
  color: #333;
}
.v-navigation-drawer {
  border-radius: 0 8px 8px 0;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}
.v-list-item {
  transition: background-color 0.3s ease;
}
.v-list-item:hover {
  background-color: rgba(255, 255, 255, 0.1);
}
.main-content {
  margin-top: 64px;
  padding: 24px;
}
.mobile-menu-icon {
  color: #ffffff;
  font-size: 26px;
}
</style>
