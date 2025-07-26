const successMessages = {
  registrationSuccess: "Registration successful",
  loginSuccess: "Login successful",
  profileUpdated: "Profile updated successfully",
  profileRetrieved: "User profile retrieved successfully",
  searchProfilesSuccess: "Profiles retrieved successfully",
  groupCreated: "Group created successfully",
  sessionCreated: "Study session created successfully",
  musicRecommendationSuccess: "Music recommendations retrieved successfully",
  aiChatResponseSuccess: "AI chat response retrieved",
};

const errorMessages = {
  registrationFailed: "Server error during registration.",
  loginFailed: "Server error during login.",
  userNotFound: "User not found.",
  updateProfileFailed: "Failed to update profile.",
  profileFetchFailed: "Failed to retrieve profile.",
  searchProfilesFailed: "Failed to search user profiles.",
  groupCreationFailed: "Failed to create group.",
  sessionCreationFailed: "Failed to create study session.",
  musicRecommendationFailed: "Failed to retrieve music recommendations.",
  aiChatFailed: "Failed to get AI response.",
  missingRequiredFields: "Name, email, and password are required.",
  userExists: "User already exists.",
  invalidCredentials: "Invalid email or password.",
};

module.exports = { successMessages, errorMessages };
