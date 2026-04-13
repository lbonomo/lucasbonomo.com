( function( blocks, blockEditor, components, element, data, i18n, serverSideRender ) {
	var createElement = element.createElement;
	var Fragment = element.Fragment;
	var InspectorControls = blockEditor.InspectorControls;
	var PanelColorSettings = blockEditor.PanelColorSettings;
	var useBlockProps = blockEditor.useBlockProps;
	var PanelBody = components.PanelBody;
	var SelectControl = components.SelectControl;
	var RangeControl = components.RangeControl;
	var FontSizePicker = components.FontSizePicker;
	var BaseControl = components.BaseControl;
	var Notice = components.Notice;
	var Placeholder = components.Placeholder;
	var Spinner = components.Spinner;
	var Card = components.Card;
	var CardBody = components.CardBody;
	var useSelect = data.useSelect;
	var __ = i18n.__;
	var ServerSideRender = serverSideRender;

	blocks.registerBlockType( 'simple-service/services-grid', {
		edit: function( props ) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;
			var selectedIds = Array.isArray( attributes.selectedServiceIds ) ? attributes.selectedServiceIds.map( String ) : [];
			var cardHeight = Number.isFinite( attributes.cardHeight ) ? attributes.cardHeight : 160;
			var titleFontSize = Number.isFinite( attributes.titleFontSize ) ? attributes.titleFontSize : 23;
			var descriptionFontSize = Number.isFinite( attributes.descriptionFontSize ) ? attributes.descriptionFontSize : 16;
			var fontColor = attributes.fontColor || '#0f172a';
			var cardBackground = attributes.cardBackground || '#ffffff';
			var blockProps = useBlockProps();

			var query = useSelect( function( select ) {
				return select( 'core' ).getEntityRecords( 'postType', 'service', {
					per_page: -1,
					orderby: 'title',
					order: 'asc',
					_context: 'view'
				} );
			}, [] );

			var options = ( query || [] ).map( function( service ) {
				return {
					label: service.title && service.title.rendered ? service.title.rendered : __( '(No title)', 'simple-service' ),
					value: String( service.id )
				};
			} );

			var selectedLabels = options.filter( function( option ) {
				return selectedIds.indexOf( option.value ) !== -1;
			} ).map( function( option ) {
				return option.label;
			} );

			return createElement(
				Fragment,
				null,
				createElement(
					InspectorControls,
					null,
					createElement(
						PanelBody,
						{
							title: __( 'Select services', 'simple-service' ),
							initialOpen: true
						},
						query === null && createElement( Spinner, null ),
						query !== null && ! options.length && createElement(
							Notice,
							{
								status: 'warning',
								isDismissible: false
							},
							__( 'Create services first to populate this list.', 'simple-service' )
						),
						query !== null && !! options.length && createElement( SelectControl, {
							label: __( 'Services', 'simple-service' ),
							help: __( 'Hold Ctrl or Cmd to select multiple services. The saved order follows the selection list order.', 'simple-service' ),
							multiple: true,
							size: Math.min( 10, Math.max( 4, options.length ) ),
							value: selectedIds,
							options: options,
							onChange: function( value ) {
								var nextValue = Array.isArray( value ) ? value : [ value ];
								setAttributes( {
									selectedServiceIds: nextValue.filter( Boolean ).map( function( item ) {
										return parseInt( item, 10 );
									} )
								} );
							}
						} )
					),
					createElement(
						PanelBody,
						{
							title: __( 'Card settings', 'simple-service' ),
							initialOpen: false
						},
						createElement( RangeControl, {
							label: __( 'Card height (px)', 'simple-service' ),
							value: cardHeight,
							onChange: function( value ) {
								setAttributes( {
									cardHeight: value || 160
								} );
							},
							min: 160,
							max: 700,
							step: 10
						} ),
						createElement( BaseControl,
							{ label: __( 'Title font size', 'simple-service' ) },
							createElement( FontSizePicker, {
								value: titleFontSize,
								onChange: function( value ) {
									setAttributes( { titleFontSize: value || 23 } );
								},
								withSlider: true
							} )
						),
						createElement( BaseControl,
							{ label: __( 'Description font size', 'simple-service' ) },
							createElement( FontSizePicker, {
								value: descriptionFontSize,
								onChange: function( value ) {
									setAttributes( { descriptionFontSize: value || 16 } );
								},
								withSlider: true
							} )
						),
						createElement( PanelColorSettings, {
							title: __( 'Color settings', 'simple-service' ),
							colorSettings: [ {
								value: cardBackground,
								onChange: function( value ) {
									setAttributes( {
										cardBackground: value || '#ffffff'
									} );
								},
								label: __( 'Card background', 'simple-service' )
							}, {
								value: fontColor,
								onChange: function( value ) {
									setAttributes( {
										fontColor: value || '#0f172a'
									} );
								},
								label: __( 'Font color', 'simple-service' )
							} ]
							} )
				),
				),
				createElement(
					'div',
					blockProps,
					selectedIds.length ? createElement(
						Card,
						{ className: 'simple-service-grid-editor__preview-card' },
						createElement(
							CardBody,
							null,
							createElement(
								'p',
								{ className: 'simple-service-grid-editor__selection' },
								__( 'Selected:', 'simple-service' ) + ' ' + selectedLabels.join( ', ' )
							),
							createElement(
								'div',
								{ className: 'simple-service-grid-editor__preview' },
								createElement( ServerSideRender, {
									block: 'simple-service/services-grid',
									attributes: attributes
								} )
							)
						)
					) : createElement(
						Placeholder,
						{
							label: __( 'Services Grid', 'simple-service' ),
							instructions: __( 'Choose the services to render in the grid from the block sidebar.', 'simple-service' )
						},
						createElement(
							'p',
							{ className: 'simple-service-grid-editor__selection' },
							__( 'No services selected yet.', 'simple-service' )
						)
					)
				)
			);
		},
		save: function() {
			return null;
		}
	} );
} )( window.wp.blocks, window.wp.blockEditor, window.wp.components, window.wp.element, window.wp.data, window.wp.i18n, window.wp.serverSideRender );
