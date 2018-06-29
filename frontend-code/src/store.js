const storeConfig = {
  getters: {
    userDetails: state => state.userDetails,
    validationErrors: state => state.validationErrors,
    registrationDetails: state => state.registrationDetails,
    isLoggedIn: state => state.isLoggedIn
  },
  state: {
    userDetails: {},
    validationErrors: [],
    registrationDetails: {},
    isLoggedIn: false
  },
  mutations: {
    setIsLoggedIn(state, isLoggedIn) {
      state.isLoggedIn = isLoggedIn;
    },
    setValidationErrors(state, validationErrors) {
      state.validationErrors = validationErrors;
    },
    setUserDetails(state, userDetails) {
      state.userDetails = userDetails;
    },
    setRegistrationDetails(state, registrationDetails) {
      state.registrationDetails = registrationDetails;
    },
    addRegistrationDetails(state, newDetail) {
      state.registrationDetails[newDetail[0]] = newDetail[1];
    },
    setUserSpaceShips(state, spaceships) {
      state.userDetails.spaceShips = spaceships;
    }
  },
  actions: {}
};

export default storeConfig;
