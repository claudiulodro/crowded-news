import React from 'react';
import ReactDOM from 'react-dom';

/**
 * Adds zazz to DocLinks.
 */
class ArrowFlair extends React.Component {

	render() {
		if ( ! this.props.visible ) {
			return null;
		}

		const borderWidth = parseInt( this.props.height ) / 2;

		const dimensionTweaks = {
			borderTopWidth: borderWidth + 'px',
			borderBottomWidth: borderWidth + 'px'
		};

		return (
			<div className="arrow" style={ dimensionTweaks } ></div>
		);
	}
}

/**
 * A link to a document for the viewer.
 */
class DocLink extends React.Component {

	constructor( props ) {
		super( props );

		this.state = {
			height: 0
		}
	}

	componentDidMount() {
		window.addEventListener( 'resize', () => { this.updateHeight() } );
		this.updateHeight();
		setInterval( () => { this.updateHeight() }, 500 );
	}

	updateHeight() {
		// Do measurements with jQuery to normalize across browsers.
		// @todo switch to an npm package that does this.
		const $node = jQuery( ReactDOM.findDOMNode( this ) );
		const padding = 20;
		const height = $node.height() + padding;
		this.setState( { height: height } );
	}

	render() {
		return (
			<a href="javascript:void(0)"
				key={ this.props.link.url }
				className={ 'link' + ( this.props.active ? ' active' : '' ) }
				onClick={ () => this.props.interactionHandler() }
				onMouseOver={ () => this.props.interactionHandler() }
			>
				{ this.props.link.text }
				<ArrowFlair height={ this.state.height } visible={ this.props.active } />
			</a>

		);
	}
}

/**
 * A large document-viewer interface.
 */
class Viewer extends React.Component {

	constructor( props ) {
		super( props );
		this.state = {
			activeLink: props.docLinks[0]
		};
	}

	handleInteraction( link ) {
		if ( this.state.activeLink.url === link.url ) {
			return;
		}
		this.setState( { activeLink: link } );
	}

	render() {
		const links = this.props.docLinks.map( ( link ) =>
			<DocLink 
				link={ link } 
				interactionHandler={ () => this.handleInteraction( link ) }
				active={ this.state.activeLink.url === link.url } />
		);

		return (
			<div className="container">
				<div className="links">
					{links}
				</div>
				<div className="viewer">
					<iframe className="viewscreen" width="800" height="800" src={ this.state.activeLink.url + '?viewscreen=1' }></iframe>
				</div>
			</div>
		);
	}
}

/**
 * Get the party started.
 */
var viewLinks = [];
var viewables = document.getElementsByClassName( 'h-viewable' );
if ( viewables.length && window.innerWidth > 800 ) {
	for ( var i = 0; i < viewables.length; ++i ) {
		viewLinks.push( {
			url: viewables[i].getAttribute( 'href' ),
			text: viewables[i].textContent
		} );
	}
	ReactDOM.render( <Viewer docLinks={viewLinks} />, document.getElementById( 'h-viewer' ) );
}
