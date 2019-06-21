jQuery(document).ready(function($) {
	// minwords, maxwords, words extra validators
	var countWords = function (string) {
	  return string
	      .replace( /(^\s*)|(\s*$)/gi, "" )
	      .replace( /[ ]{2,}/gi, " " )
	      .replace( /\n /, "\n" )
	      .split(' ').length;
	};

	window.ParsleyValidator.addValidator(
		'minwords',
		function (value, nbWords) {
			return countWords(value) >= nbWords;
		}, 32)
		.addMessage('en', 'minwords', 'This value needs more words');

	window.ParsleyValidator.addValidator(
		'maxwords',
		function (value, nbWords) {
			return countWords(value) <= nbWords;
		}, 32)
		.addMessage('en', 'maxwords', 'This value needs fewer words');

	window.ParsleyValidator.addValidator(
		'words',
		function (value, arrayRange) {
			var length = countWords(value);
			return length >= arrayRange[0] && length <= arrayRange[1];
		}, 32)
		.addMessage('en', 'words', 'This value has the incorrect number of words');

	// gt, gte, lt, lte extra validators
	var parseRequirement = function (requirement) {
	  if ( isNaN( +requirement ) ) {
	    return parseFloat( $( requirement ).val() );
	  }
	  else {
	    return +requirement;
	  }
	};

	// gt, gte, lt, lte extra validators
	window.ParsleyConfig = window.ParsleyConfig || {};
	window.ParsleyConfig.validators = window.ParsleyConfig.validators || {};

	// Greater than validator
	window.ParsleyConfig.validators.gt = {
	  fn: function (value, requirement) {
	    return parseFloat(value) > parseRequirement(requirement);
	  },
	  priority: 32
	};

	// Greater than or equal to validator
	window.ParsleyConfig.validators.gte = {
	  fn: function (value, requirement) {
	    return parseFloat(value) >= parseRequirement(requirement);
	  },
	  priority: 32
	};

	// Less than validator
	window.ParsleyConfig.validators.lt = {
	  fn: function (value, requirement) {
	    return parseFloat(value) < parseRequirement(requirement);
	  },
	  priority: 32
	};

	// Less than or equal to validator
	window.ParsleyConfig.validators.lte = {
	  fn: function (value, requirement) {
	    return parseFloat(value) <= parseRequirement(requirement);
	  },
	  priority: 32
	};
});