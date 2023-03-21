# Badge URL Conventions Guide

## Badge URL Format

New badges should follow this format: `/service/noun/parameters?querystring`. For example: `/github/issues/:user/:repo`. In this case, the service is GitHub, the badge is for issues, and the parameters are `:user/:repo`.

## Noun Usage

- Use singular nouns if the badge message represents a single entity, such as the current status of a build (e.g., `/build`) or a more abstract or aggregate representation of the thing (e.g., `/coverage`, `/quality`).
- Use plural nouns if there are (or may) be multiple entities (e.g., `/dependencies`, `/stars`).

## Parameters

- Include parameters in the route if they are required to display a badge (e.g., `:packageName`).
- Common optional parameters, such as `:branch` or `:tag`, should also be part of the route.

## Query String Parameters

Use query string parameters when:

- The parameter is related to formatting (e.g., `/appveyor/tests/:user/:repo?compact_message`).
- The parameter is for an uncommon optional attribute, like an alternate registry URL.
- The parameter triggers alternative logic application, like version semantics (e.g., `/github/v/tag/:user/:repo?sort=semver`).
- Services requiring a URL/hostname parameter should always use a query string parameter to accept that value (e.g., `/discourse/topics?server=https://meta.discourse.org`).

## Standard Routes and Abbreviations

Adhere to these standard routes and abbreviations across services:

- Coverage: `/coverage`
- Downloads or Installs:
  - Total: `/dt` (use this even for services that only provide total download/install data)
  - Recent: `/dr`
  - Per year: `/dy`
  - Per quarter: `/dq`
  - Per month: `/dm`
  - Per week: `/dw`
  - Per day: `/dd`
- Rating:
  - Numeric: `/rating`
  - Stars: `/stars`
- License: `/l`
- Version or Release: `/v`
