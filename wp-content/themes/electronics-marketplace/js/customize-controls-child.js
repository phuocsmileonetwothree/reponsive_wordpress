( function( api ) {
	// Extends our custom "electronics-marketplace" section.
	api.sectionConstructor['electronics-marketplace'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

