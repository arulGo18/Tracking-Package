<?php

function statusBadge($status)
{
    switch ($status) {

        case 'Created':
            return '<span class="badge bg-secondary">Created</span>';

        case 'Packed':
            return '<span class="badge bg-info text-dark">Packed</span>';

        case 'In Transit':
            return '<span class="badge bg-warning text-dark">In Transit</span>';

        case 'Arrived Indonesia':
            return '<span class="badge bg-primary">Arrived Indonesia</span>';

        case 'Delivered to Reseller':
            return '<span class="badge bg-success">Delivered to Reseller</span>';

        case 'Delivered':
            return '<span class="badge bg-success">Delivered</span>';

        default:
            return '<span class="badge bg-dark">' . $status . '</span>';
    }
}