<?php


namespace Core\Services\Libraries;


interface ShoppingCartInterface
{

    /**
     * Insert items into the cart and save it to the session table
     *
     * @param array $items
     *
     * @return bool
     */
    public function insert(array $items = []): bool;

    // ------------------------------------------------------------------------

    /**
     * Update the cart
     *
     * This function permits the quantity of a given item to be changed.
     * Typically it is called from the "view cart" page if a user makes
     * changes to the quantity before checkout. That array must contain the
     * product ID and quantity for each item.
     *
     * @param array $items
     *
     * @return bool
     */
    public function update(array $items = []): bool;

    // ------------------------------------------------------------------------

    /**
     * ShoppingCart Total
     *
     * @return mixed
     */
    public function total(): mixed;

    // ------------------------------------------------------------------------

    /**
     * Remove Item
     *
     * Removes an item from the cart
     *
     * @param $rowID
     *
     * @return bool
     */
    public function remove($rowID): bool;

    // ------------------------------------------------------------------------

    /**
     * Total Items
     *
     * Returns the total item count
     *
     * @return mixed
     */
    public function totalItems(): mixed;

    // ------------------------------------------------------------------------

    /**
     * ShoppingCart Contents
     *
     * Returns the entire cart array
     *
     * @param bool $newest_first
     *
     * @return array
     */
    public function contents(bool $newest_first = false): array;

    // ------------------------------------------------------------------------

    /**
     * Get cart item
     *
     * Returns the details of a specific item in the cart
     *
     * @param $row_id
     *
     * @return mixed
     */
    public function getItem($row_id): mixed;

    // ------------------------------------------------------------------------

    /**
     * Destroy the cart
     *
     * Empties the cart and kills the session
     */
    public function destroy(): void;
}
