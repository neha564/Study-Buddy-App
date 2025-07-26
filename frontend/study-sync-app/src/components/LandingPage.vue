<template>
  <div class="landing-page">
    <header>
      <h1>Welcome to StudySync</h1>
      <p>
        Your ultimate productivity companion. Organize, focus, and achieve your
        goals.
      </p>
      <button @click="navigateToApp">Get Started</button>
    </header>

    <section class="features">
      <!-- Existing Features -->
      <div class="feature" v-for="feature in features" :key="feature.title">
        <h3>{{ feature.title }}</h3>
        <p>{{ feature.description }}</p>
      </div>
    </section>

    <footer>
      <p>
        <strong
          >Note: You must be logged in to access the app. Click
          <a href="/login">here</a> to login.</strong
        >
      </p>
    </footer>

    <!-- Horizontal Line -->
    <div style="margin-top: 2em; border-top: 1px solid #ddd"></div>

    <footer>
      <p>
        <strong>StudySync - Empowering your productivity journey. 🚀</strong>
      </p>
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      features: [
        {
          title: "Music Recommendations",
          description:
            "Find the perfect soundtrack for your study sessions based on your mood.",
        },
        {
          title: "Pomodoro Timer",
          description:
            "Stay focused with timed intervals that maximize productivity.",
        },
        {
          title: "To-Do List",
          description:
            "Keep track of tasks and stay on top of your responsibilities.",
        },
        {
          title: "Flashcards",
          description:
            "Review key concepts and boost your memory with interactive flashcards.",
        },
        {
          title: "AI Chat",
          description:
            "Get answers, tips, and motivation from our AI-powered chat assistant.",
        },
        {
          title: "Weather",
          description:
            "Plan your day better with accurate, location-based weather updates.",
        },
        {
          title: "Quick Notes",
          description: "Jot down quick notes and thoughts to stay organized.",
        },
        {
          title: "Calculator",
          description:
            "A full-featured calculator to handle all your quick calculations.",
        },
        {
          title: "Study Tips",
          description:
            "Get daily study tips to enhance your learning efficiency.",
        },
        {
          title: "Daily Motivation",
          description:
            "Start your day with a dose of motivation to stay inspired.",
        },
      ],
    };
  },
  methods: {
    navigateToApp() {
      this.$router.push("/login");
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

.landing-page {
  font-family: "Poppins", sans-serif;
  color: #333;
  text-align: center;
  padding: 2em;
  overflow-x: hidden;
}

header {
  background: linear-gradient(135deg, #3949ab, #5f5fc1);
  padding: 3em;
  border-radius: 15px;
  color: #fff;
  margin-bottom: 2em;
  animation: fadeIn 1.5s ease-out;
}

header h1 {
  font-size: 2.5em;
  margin: 0.5em 0;
}

header p {
  font-size: 1.2em;
  margin: 0.5em 0 1.5em;
}

header button {
  background-color: #ff6f61;
  color: #fff;
  padding: 12px 24px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
  transition:
    background-color 0.3s ease,
    transform 0.3s ease;
}

header button:hover {
  background-color: #ff8a80;
  transform: scale(1.05);
}

.features {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 2em;
  padding: 0 2em;
  animation: slideInUp 1.5s ease-out;
}

.feature {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  padding: 2em;
  text-align: center;
  transition:
    transform 0.3s ease,
    box-shadow 0.3s ease;
  animation: popIn 0.5s ease-out;
  animation-delay: calc(var(--index) * 0.1s);
  opacity: 0;
  animation-fill-mode: forwards;
}

.feature:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.feature h3 {
  color: #3949ab;
  margin-bottom: 0.5em;
}

footer {
  margin-top: 2em;
  font-size: 1em;
  color: #777;
}

footer a {
  color: #3949ab;
  text-decoration: none;
}

footer a:hover {
  text-decoration: underline;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes popIn {
  0% {
    opacity: 0;
    transform: scale(0.9);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}
</style>
