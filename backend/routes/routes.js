const express = require("express");
const controller = require("../controllers/controllers");
const authMiddleware = require("../middleware/middleware");

const router = express.Router();

router.post("/auth/register", controller.register);
router.post("/auth/login", controller.login);
router.post("/auth/verify-email", controller.verifyEmail);
router.post("/auth/reset-password", controller.resetPassword);
router.get("/profile/:userId?", authMiddleware, controller.getProfile);
router.put("/profile", authMiddleware, controller.updateProfile);
router.get("/search", authMiddleware, controller.searchProfiles);
router.get("/weather", controller.getWeather);
router.post("/groups", authMiddleware, controller.createGroup);
router.post(
  "/groups/:groupId/sessions",
  authMiddleware,
  controller.createSession,
);
router.get("/cities", controller.getCitySuggestions);
router.get("/music", authMiddleware, controller.getMusic);
router.post("/ai-chat", authMiddleware, controller.aiChat);

module.exports = router;
