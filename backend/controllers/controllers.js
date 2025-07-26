const { User, Group } = require("../models/models");
const jwt = require("jsonwebtoken");
const bcrypt = require("bcryptjs");
const { successMessages, errorMessages } = require("../views/views");
const { getMusicRecommendation, chatWithAI } = require("../services/services");
const { get } = require("axios");

/**
 * @swagger
 * tags:
 *   - name: Authentication
 *     description: User authentication and management
 */

/**
 * @swagger
 * tags:
 *  - name: User
 *    description: User profile and search operations
 */

/**
 * @swagger
 * tags:
 * - name: Groups
 *   description: Study group and session operations
 */

/**
 * @swagger
 * tags:
 * - name: Music
 *   description: Music recommendation operations
 */

/**
 * @swagger
 * tags:
 * - name: AI Chat
 *   description: AI chatbot operations
 */

/**
 * @swagger
 * tags:
 * - name: Weather
 *   description: Weather data operations
 */

/**
 * @swagger
 * tags:
 * - name: Cities
 *   description: City suggestion operations
 */

/**
 * @swagger
 * /api/auth/register:
 *   post:
 *     summary: Register a new user
 *     tags: [Authentication]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - name
 *               - email
 *               - password
 *             properties:
 *               name:
 *                 type: string
 *               email:
 *                 type: string
 *               password:
 *                 type: string
 *     responses:
 *       201:
 *         description: User registered successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 token:
 *                   type: string
 *       400:
 *         description: Missing required fields
 *       409:
 *         description: User already exists
 *       500:
 *         description: Server error
 */
exports.register = async (req, res) => {
  try {
    const { name, email, password } = req.body;

    if (!name || !email || !password) {
      return res
        .status(400)
        .json({ success: false, message: errorMessages.missingRequiredFields });
    }

    const existingUser = await User.findOne({ email });
    if (existingUser) {
      return res
        .status(409)
        .json({ success: false, message: errorMessages.userExists });
    }

    const hashedPassword = await bcrypt.hash(password, 10);
    const user = new User({ name, email, password: hashedPassword });
    await user.save();

    const token = jwt.sign({ id: user._id }, process.env.JWT_SECRET, {
      expiresIn: "1h",
    });
    res.status(201).json({
      success: true,
      message: successMessages.registrationSuccess,
      token,
    });
  } catch (error) {
    console.error("Registration error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.registrationFailed });
  }
};

/**
 * @swagger
 * /api/auth/login:
 *   post:
 *     summary: Login a user
 *     tags: [Authentication]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - email
 *               - password
 *             properties:
 *               email:
 *                 type: string
 *               password:
 *                 type: string
 *     responses:
 *       200:
 *         description: User logged in successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 token:
 *                   type: string
 *       401:
 *         description: Invalid credentials
 *       500:
 *         description: Server error
 */
exports.login = async (req, res) => {
  try {
    const { email, password } = req.body;
    const user = await User.findOne({ email });

    if (!user || !(await bcrypt.compare(password, user.password))) {
      return res
        .status(401)
        .json({ success: false, message: errorMessages.invalidCredentials });
    }

    const token = jwt.sign({ id: user._id }, process.env.JWT_SECRET, {
      expiresIn: "1h",
    });
    res.json({ success: true, message: successMessages.loginSuccess, token });
  } catch (error) {
    console.error("Login error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.loginFailed });
  }
};

/**
 * @swagger
 * /api/profile/{userId}:
 *   get:
 *     summary: Get user profile by userId
 *     tags: [User]
 *     parameters:
 *       - in: path
 *         name: userId
 *         required: true
 *         schema:
 *           type: string
 *         description: User's unique ID
 *     responses:
 *       200:
 *         description: Profile fetched successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 user:
 *                   type: object
 *                   properties:
 *                     name:
 *                       type: string
 *                     email:
 *                       type: string
 *       404:
 *         description: User not found
 *       500:
 *         description: Server error
 */
exports.getProfile = async (req, res) => {
  try {
    const userId = req.params.userId || req.user.id;
    const user = await User.findById(userId);

    if (!user) {
      return res
        .status(404)
        .json({ success: false, message: errorMessages.userNotFound });
    }

    res.json({
      success: true,
      message: successMessages.profileRetrieved,
      user,
    });
  } catch (error) {
    console.error("Get profile error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.profileFetchFailed });
  }
};

/**
 * @swagger
 * /api/profile:
 *   put:
 *     summary: Update user profile
 *     tags: [User]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             properties:
 *               name:
 *                 type: string
 *               email:
 *                 type: string
 *     responses:
 *       200:
 *         description: Profile updated successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 user:
 *                   type: object
 *                   properties:
 *                     name:
 *                       type: string
 *                     email:
 *                       type: string
 *       404:
 *         description: User not found
 *       500:
 *         description: Server error
 */
exports.updateProfile = async (req, res) => {
  try {
    const updateData = req.body;
    const user = await User.findByIdAndUpdate(req.user.id, updateData, {
      new: true,
    });

    if (!user) {
      return res
        .status(404)
        .json({ success: false, message: errorMessages.userNotFound });
    }

    res.json({ success: true, message: successMessages.profileUpdated, user });
  } catch (error) {
    console.error("Update profile error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.updateProfileFailed });
  }
};

/**
 * @swagger
 * /api/search:
 *   get:
 *     summary: Search for profiles by name
 *     tags: [User]
 *     parameters:
 *       - in: query
 *         name: q
 *         required: true
 *         schema:
 *           type: string
 *         description: Name query string for searching
 *     responses:
 *       200:
 *         description: Profiles found
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 profiles:
 *                   type: array
 *                   items:
 *                     type: object
 *                     properties:
 *                       name:
 *                         type: string
 *                       email:
 *                         type: string
 *       404:
 *         description: No profiles found
 *       500:
 *         description: Server error
 */
exports.searchProfiles = async (req, res) => {
  try {
    const query = req.query.q;
    const profiles = await User.find({ name: new RegExp(query, "i") });

    if (!profiles.length) {
      return res
        .status(404)
        .json({ success: false, message: errorMessages.searchProfilesFailed });
    }

    res.json({
      success: true,
      message: successMessages.searchProfilesSuccess,
      profiles,
    });
  } catch (error) {
    console.error("Search profiles error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.searchProfilesFailed });
  }
};

/**
 * @swagger
 * /api/groups:
 *   post:
 *     summary: Create a new study group
 *     tags: [Groups]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - members
 *               - course
 *             properties:
 *               members:
 *                 type: array
 *                 items:
 *                   type: string
 *               course:
 *                 type: string
 *     responses:
 *       201:
 *         description: Group created successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 group:
 *                   type: object
 *                   properties:
 *                     members:
 *                       type: array
 *                       items:
 *                         type: string
 *                     course:
 *                       type: string
 *       500:
 *         description: Server error
 */
exports.createGroup = async (req, res) => {
  try {
    const { members, course } = req.body;
    const group = new Group({ members, course });
    await group.save();

    res
      .status(201)
      .json({ success: true, message: successMessages.groupCreated, group });
  } catch (error) {
    console.error("Create group error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.groupCreationFailed });
  }
};

/**
 * @swagger
 * /api/groups/{groupId}/sessions:
 *   post:
 *     summary: Create a study session within a group
 *     tags: [Groups]
 *     parameters:
 *       - in: path
 *         name: groupId
 *         required: true
 *         schema:
 *           type: string
 *         description: Group ID to create session within
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - date
 *               - mood
 *             properties:
 *               date:
 *                 type: string
 *                 format: date
 *               mood:
 *                 type: string
 *     responses:
 *       200:
 *         description: Session created successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 group:
 *                   type: object
 *                   properties:
 *                     members:
 *                       type: array
 *                       items:
 *                         type: string
 *                     course:
 *                       type: string
 *       404:
 *         description: Group not found
 *       500:
 *         description: Server error
 */
exports.createSession = async (req, res) => {
  try {
    const { date, mood } = req.body;
    const groupId = req.params.groupId;
    const group = await Group.findById(groupId);

    if (!group) {
      return res
        .status(404)
        .json({ success: false, message: errorMessages.groupCreationFailed });
    }

    group.studySessions.push({ date, mood });
    await group.save();

    res.json({ success: true, message: successMessages.sessionCreated, group });
  } catch (error) {
    console.error("Create session error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.sessionCreationFailed });
  }
};

/**
 * @swagger
 * /api/music:
 *   get:
 *     summary: Get music recommendations based on search term
 *     tags: [Music]
 *     parameters:
 *       - in: query
 *         name: searchTerm
 *         required: false
 *         schema:
 *           type: string
 *         description: Term to search for music recommendations (default is "study")
 *     responses:
 *       200:
 *         description: Music recommendations retrieved successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 recommendations:
 *                   type: array
 *                   items:
 *                     type: object
 *                     properties:
 *                       name:
 *                         type: string
 *                       artist:
 *                         type: string
 *                       image_url:
 *                         type: string
 *                       spotify_url:
 *                         type: string
 *       500:
 *         description: Server error when retrieving music recommendations
 */
exports.getMusic = async (req, res) => {
  try {
    const searchTerm = req.query.searchTerm || "study"; // Use searchTerm instead of emotion
    const recommendations = await getMusicRecommendation(searchTerm); // Pass searchTerm instead of emotion

    res.json({
      success: true,
      message: successMessages.musicRecommendationSuccess,
      recommendations,
    });
  } catch (error) {
    console.error("Get music error:", error);
    res.status(500).json({
      success: false,
      message: errorMessages.musicRecommendationFailed,
    });
  }
};

/**
 * @swagger
 * /api/ai-chat:
 *   post:
 *     summary: Chat with AI service
 *     tags: [AI Chat]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - sessionId
 *               - message
 *             properties:
 *               sessionId:
 *                 type: string
 *               message:
 *                 type: string
 *     responses:
 *       200:
 *         description: AI chat response successfully retrieved
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 response:
 *                   type: string
 *       500:
 *         description: Server error when interacting with AI
 */
exports.aiChat = async (req, res) => {
  try {
    const { sessionId, message } = req.body;
    const aiResponse = await chatWithAI(sessionId, message);

    res.json({
      success: true,
      message: successMessages.aiChatResponseSuccess,
      response: aiResponse,
    });
  } catch (error) {
    console.error("AI chat error:", error);
    res
      .status(500)
      .json({ success: false, message: errorMessages.aiChatFailed });
  }
};

/**
 * @swagger
 * /api/weather:
 *   get:
 *     summary: Get current weather data for a specific city
 *     tags: [Weather]
 *     parameters:
 *       - in: query
 *         name: city
 *         required: true
 *         schema:
 *           type: string
 *         description: Name of the city to get the weather data for
 *     responses:
 *       200:
 *         description: Weather data successfully retrieved
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *                 data:
 *                   type: object
 *                   properties:
 *                     city:
 *                       type: string
 *                     temp:
 *                       type: number
 *                     condition:
 *                       type: string
 *       400:
 *         description: Missing city query parameter
 *       500:
 *         description: Server error when retrieving weather data
 */
exports.getWeather = async (req, res) => {
  try {
    const city = req.query.city;
    if (!city) {
      return res
        .status(400)
        .json({ success: false, message: "City name is required" });
    }

    const apiKey = process.env.OPENWEATHER_API_KEY;
    const response = await get(
      `https://api.openweathermap.org/data/2.5/weather`,
      {
        params: {
          q: city,
          appid: apiKey,
          units: "metric", // Converts temperature to Celsius
        },
      },
    );

    const { name, main, weather } = response.data;
    const weatherData = {
      city: name,
      temp: main.temp,
      condition: weather[0].main,
    };

    res.json({
      success: true,
      message: "Weather data retrieved successfully",
      data: weatherData,
    });
  } catch (error) {
    console.error("Error fetching weather data:", error.message);
    res
      .status(500)
      .json({ success: false, message: "Failed to retrieve weather data" });
  }
};

/**
 * @swagger
 * /api/cities:
 *   get:
 *     summary: Get city suggestions based on a search query
 *     tags: [Cities]
 *     parameters:
 *       - in: query
 *         name: query
 *         required: true
 *         schema:
 *           type: string
 *         description: Partial name of the city to get suggestions for
 *     responses:
 *       200:
 *         description: City suggestions successfully retrieved
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 cities:
 *                   type: array
 *                   items:
 *                     type: object
 *                     properties:
 *                       name:
 *                         type: string
 *                       country:
 *                         type: string
 *                       state:
 *                         type: string
 *       400:
 *         description: Query parameter must be at least 2 characters long
 *       500:
 *         description: Server error when retrieving city suggestions
 */
exports.getCitySuggestions = async (req, res) => {
  try {
    const query = req.query.query;
    if (!query || query.length < 2) {
      return res.status(400).json({
        success: false,
        message: "Query must be at least 2 characters long",
      });
    }

    const apiKey = process.env.OPENWEATHER_API_KEY;
    const response = await get(`http://api.openweathermap.org/geo/1.0/direct`, {
      params: {
        q: query,
        limit: 5, // Limit the number of suggestions returned
        appid: apiKey,
      },
    });

    const cities = response.data.map((city) => ({
      name: city.name,
      country: city.country,
      state: city.state,
    }));

    res.json({ success: true, cities });
  } catch (error) {
    console.error("Error fetching city suggestions:", error.message);
    res
      .status(500)
      .json({ success: false, message: "Failed to retrieve city suggestions" });
  }
};

/**
 * @swagger
 * /api/auth/verify-email:
 *   post:
 *     summary: Verify if an email exists in the system
 *     tags: [Authentication]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - email
 *             properties:
 *               email:
 *                 type: string
 *                 format: email
 *     responses:
 *       200:
 *         description: Email exists
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 exists:
 *                   type: boolean
 *                 message:
 *                   type: string
 *       404:
 *         description: Email not found
 *       500:
 *         description: Server error
 */
exports.verifyEmail = async (req, res) => {
  try {
    const { email } = req.body;
    const user = await User.findOne({ email });

    if (user) {
      return res.status(200).json({
        success: true,
        exists: true,
        message: "Email verified successfully.",
      });
    } else {
      return res.status(404).json({
        success: false,
        exists: false,
        message: "Email not found.",
      });
    }
  } catch (error) {
    console.error("Email verification error:", error);
    res.status(500).json({
      success: false,
      message: "Server error while verifying email.",
    });
  }
};

/**
 * @swagger
 * /api/auth/reset-password:
 *   post:
 *     summary: Reset password for a verified email
 *     tags: [Authentication]
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             type: object
 *             required:
 *               - email
 *               - newPassword
 *             properties:
 *               email:
 *                 type: string
 *                 format: email
 *               newPassword:
 *                 type: string
 *     responses:
 *       200:
 *         description: Password reset successfully
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 success:
 *                   type: boolean
 *                 message:
 *                   type: string
 *       404:
 *         description: Email not found
 *       500:
 *         description: Server error
 */
exports.resetPassword = async (req, res) => {
  try {
    const { email, newPassword } = req.body;
    const user = await User.findOne({ email });

    if (!user) {
      return res.status(404).json({
        success: false,
        message: "User with this email not found.",
      });
    }

    const hashedPassword = await bcrypt.hash(newPassword, 10);
    user.password = hashedPassword;
    await user.save();

    res.status(200).json({
      success: true,
      message: "Password reset successfully.",
    });
  } catch (error) {
    console.error("Password reset error:", error);
    res.status(500).json({
      success: false,
      message: "Server error while resetting password.",
    });
  }
};
