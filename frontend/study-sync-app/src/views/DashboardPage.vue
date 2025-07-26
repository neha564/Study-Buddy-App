<template>
  <div>
    <h2>Dashboard</h2>
    <Profile />
    <Group />
    <MusicRecommendation />
    <ChatAI />
  </div>
</template>

<script>
import Profile from "../components/UserProfile.vue";
import Group from "../components/StudyGroup.vue";
import MusicRecommendation from "../components/MusicRecommendation.vue";
import ChatAI from "../components/ChatAI.vue";

export default {
  components: { Profile, Group, MusicRecommendation, ChatAI },
};
</script>
