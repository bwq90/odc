var $=jQuery.noConflict();

/**
 * Run Isotope plugin
 * @container element cointaining items
 * @item element inside the container
**/
function runIsotope( container, item ){

    var $container = $(container);
    $container.imagesLoaded( function(){
        $container.isotope({
            itemSelector : item,
            layoutMode: 'masonry',
            masonry: {
                columnWidth: item
            },
            getSortData: {
                title:      '.post__title',
                date:       '.post__date',
                country:    '.post__country',
                author:     '.post__author'
            }
        });
    });
}// runIsotope


/**
 * Filters with Isotope for Working Groups
 * @container element cointaining items
**/
function initWorkingGroupFilters( ){
    var $container = $('.posts-container');
    var groupActive = $container.attr('data-group_active');
    
    if (groupActive != '.ninguno') {
        $container.isotope({ filter: groupActive });
    };

    // store filter for each group
    var filters = {};

    $('.wg-filters').on( 'click', 'a', function() {
        var $this = $(this);
        // get group key
        var $buttonGroup = $this.parents('.button-group');
        var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
        filters[ filterGroup ] = $this.attr('data-filter');
        // combine filters
        var filterValue = concatValues( filters );
        // set filter for Isotope
        $container.attr('data-group_active', filterValue);
        $container.isotope({ filter: filterValue });
    });

    // add an active class to active filters
    $('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'a', function( e ) {
            e.preventDefault();
            $buttonGroup.find('.active').removeClass('active');
            $( this ).addClass('active');
        });
    });
}// initWorkingGroupFilters

// flatten object by concatting values
function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) value += obj[ prop ];
    return value;
}


/*jshint browser:true, undef: true, unused: true, jquery: true */
function initCheckBoxFilters(){

    var $container;
    var filters = {};
    $container = $('.posts-container');
    runIsotope( '.posts-container', '.post');

    //$container.isotope();
    // do stuff when checkbox change
    $('.option-set').on( 'change', function( jQEvent ) {
        var groupActive = $container.attr('data-group_active');
        
        var $checkbox = $( jQEvent.target );
        manageCheckbox( $checkbox, filters );
        var comboFilter = getComboFilter( filters );

        $('.button-group a').removeClass('active');
        
        $container.isotope({ filter: comboFilter });

    });
}

function getComboFilter( filters ) {
    var i = 0;
    var comboFilters = [];
    var message = [];

    for ( var prop in filters ) {
        message.push( filters[ prop ].join(' ') );
        var filterGroup = filters[ prop ];
        // skip to next filter group if it doesn't have any values
        if ( !filterGroup.length ) continue;

        if ( i === 0 ) {
            comboFilters = filterGroup.slice(0);
        } else {
            var filterSelectors = [];
            // copy to fresh array
            var groupCombo = comboFilters.slice(0); // [ A, B ]
            // merge filter Groups
            for (var k=0, len3 = filterGroup.length; k < len3; k++) {
                for (var j=0, len2 = groupCombo.length; j < len2; j++) {
                    filterSelectors.push( groupCombo[j] + filterGroup[k] ); // [ 1, 2 ]
                }
            }
            // apply filter selectors to combo filters for next group
            comboFilters = filterSelectors;
        }
        i++;
    }
    var comboFilter = comboFilters.join(', ');
    return comboFilter;
}

function manageCheckbox( $checkbox, filters ) {
    var checkbox = $checkbox[0];
    var group = $checkbox.parents('.option-set').attr('data-group');

    // create array for filter group, if not there yet
    var filterGroup = filters[ group ];
    if ( !filterGroup ) {
        filterGroup = filters[ group ] = [];
    }

    var isAll = $checkbox.hasClass('all');
    // reset filter group if the all box was checked
    if ( isAll ) {
        delete filters[ group ];
        if ( !checkbox.checked ) {
            checkbox.checked = 'checked';
        }
        $('.'+group+'-a').remove();
    }
    // index of
    var index = $.inArray( checkbox.value, filterGroup );


    if ( checkbox.checked ) {
        var selector = isAll ? 'input' : 'input.all';

        $checkbox.siblings( selector ).removeAttr('checked');

        if ( !isAll && index === -1 ) {
            // add filter to group
            filters[ group ].push( checkbox.value );
           
        }

        if ( !isAll ){
            var name = $checkbox.attr('data-name');
            var slug = $checkbox.attr('id');

            var html = '<span class="'+slug+'-a '+group+'-a" data-filtro="'+slug+'">'+name+'<img class="quitar-filtro" data-filtro="'+slug+'" src="'+theme_path+'/images/cruz-azul-marca.png"></span>';
            $('.datos-busquedas-centre').append(html);
        }

    } else if ( !isAll ) {

        console.log('here');
        // remove filter from group
        var no_select = filters[ group ].splice( index, 1 );

        $(no_select+'-a').remove();
        // if unchecked the last box, check the all
        // if ( !$checkbox.siblings('checked').length ) {
        //     $checkbox.siblings('input.all').attr('checked', 'checked');
        // }
    }

}

$(document).on('click','.quitar-filtro', function(){
    var filtro = $(this).attr('data-filtro');
    var comboFilter = [];
    $('#'+filtro).removeAttr('checked');
    $('.'+filtro+'-a').remove();

    $(".datos-busquedas-centre span").each(function (index, element) 
    { 
       comboFilter.push('.'+$(this).attr('data-filtro'));

    });

    var comboFilter = comboFilter.join(', ');

    $('.posts-container').isotope({ filter: comboFilter });

    comboFilter = [];

   
});

$( document ).on( 'click', '.js-sort', function ( e ) {
    var el      = $( e.currentTarget );
    var form    = $( '#resources-search' );

    $( 'input[name="search-order"]', form ).val( el.data( 'sort' ) );
    form.submit();
});

$( document ).on( 'click', '.principle-filter', function ( e ) {
    var el      = $( e.currentTarget );
    var form    = $( '#resources-search' );

    $( 'input[name="search-principle-filter"]', form ).val( el.data( 'filter' ) );
    form.submit();
});

$( document ).on( 'change', '.resources-results-filter', function ( e ) {
    var el      = $( e.currentTarget );
    var form    = $( '#resources-search' );

    $( 'input[name="search-' + el.data( 'filter-group' ) + '"]', form ).val( el.val() );
    form.submit();
});

$( document ).on( 'hover', '#filters-title > img', function ( e ) {
    e.preventDefault();
    $( '#filters-title > .filters-tooltip' ).toggle();
});

$( document ).ready( function () {
    if ( $( '.page-anticorruption' ).length > 0 ) {
        $( '.anticorruption-sidebar img' ).load( function () {
            var sidebar         = $( '.anticorruption-sidebar' ),
                contentHeight   = $( '.anticorruption-content' ).height() + 30;

            if ( sidebar.height() < contentHeight ) {
                sidebar.height( contentHeight );
            }
        });
    }
});

$( document ).ready( function () {
    $( '.collapsible-box .box-title' ).click( function ( e ) {
        e.preventDefault();
        var el  = $( e.currentTarget );

        el.toggleClass( 'closed' ).parent().find( '.box-content' ).slideToggle();

        return false;
    });
});