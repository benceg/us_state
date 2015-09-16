# `{exp:us_state}`

This ExpressionEngine plugin converts US state names to initials, and initials back to names.

## Installation

- Drop the `us_state` folder into `system/expressionengine/third_party`.

## Usage

- To convert a state's initials to its full name:
    ```
    {exp:us_state:initials state="NY"}
    ```

- To convert a state's full name to its initials:
    ```
    {exp:us_state:initials state="New York"}
    ```