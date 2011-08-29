<?php
/**
 * Implementation of Connection_Protocol_Interface to be
 * suitable for usage as data encoding/decoding
 * protocol for http://soap.direct.yandex.ru/json-api/v4
 * 
 * @author Cyril A. Karpenko <self@nikelin.ru>
 * @company Redshape Ltd. <company@redshape.ru>
 */
class Connection_Protocol_JSON implements Connection_Protocol_Interface
{

    public static $nullToken = "null";

    public function hydrateResponse(Connection_Request_Interface $request, 
                                    $rawData) 
    {
        $jsonData = Utils::jsonDecode(
            StringUtils::selectBetween(
                $rawData, 
                strpos($rawData, "{"), 
                StringUtils::lastIndexOf($rawData, "}")
            )
        );
        if ($jsonData == null) {
            throw new Exception(
                sprintf(
                    "Response decoding exception! \n Response Body: %s", 
                    $rawData
                )
            );
        }

        if (array_key_exists("error_code", $jsonData)) {
            return new Connection_Response_Error($jsonData);
        }

        return $request->createResponse($jsonData);
    }

    public function renderRequest(Connection_Request_Interface $request) 
    {
        $result = array();
        $result["method"] = $request->getMethod();

        if (!$request->isScalarParameter()) {
            $result["param"] = $this->prepareFieldNames(
                $request->getParameters()
            );
        } else {
            $result["param"] = $request->getScalarParameter();
        }

        $result = array_merge($result, $request->getHeaders());


        return $this->renderMap($result);
    }

    protected function prepareFieldNames(array $fields) 
    {
        $result = array();
        foreach ($fields as $key => $field) {
            if (is_numeric($key)) {
                $result[] = $field;
                continue;
            }

            if ($field instanceof Entities_Field_Interface) {
                $value = $field->getValue();
                $name = $field->getName();
                if ($value != NULL && is_array($value)) {
                    $value = $this->prepareFieldNames($value);
                }
            } else {
                $name = $key;
                $value = $field;
            }

            $result[$this->prepareFieldName($name)] = $value;
        }

        return $result;
    }

    protected function prepareFieldName($name) 
    {
        return ucfirst($name);
    }

    protected function renderValue($value) 
    {
        if ($value == NULL) {
            return self::$nullToken;
        }

        if (is_numeric($value)) {
            return $value;
        } else if (is_bool($value)) {
            return ($value ? "\"Yes\"" : "\"No\"");
        } else {
            return "\"" . addslashes($value) . "\"";
        }
    }

    protected function renderEntity(Entities_Interface $value) 
    {
        return $this->renderMap($value->getFields());
    }

    protected function renderMap($object) 
    {
        $result = "{";
        $i = 0;
        foreach ($object as $k => $v) {
            $value = $this->renderObject($v);
            if ($value !== self::$nullToken
                    || !RENDERER_SKIP_NULLED) {
                $result .= "\"" . $k . "\"" . " : " . $value;
            }

            if ($i++ != count($object) - 1) {
                $result .= ", ";
            }
        }
        $result .= "}";

        return $result;
    }

    protected function renderArray(array $values) 
    {
        $result = "[ ";
        $i = 0;
        foreach ($values as $index => $value) {
            $value = $this->renderObject($value);
            if ($value != self::$nullToken
                    || !RENDERER_SKIP_NULLED) {
                $result .= $value;
            }

            if ($i++ != count($values) - 1) {
                $result .= ", ";
            }
        }
        $result .= "] ";
        return $result;
    }

    protected function renderField(Entities_Field_Interface $field) 
    {
        if ($field instanceof Entities_Field_Reference) {
            return $this->renderMap($field->getValue()->getFields());
        } else if ($field instanceof Entities_Field_Array) {
            return $this->renderArray($field->getValue());
        } else {
            return $this->renderObject($field->getValue());
        }
    }

    protected function renderObject($value) 
    {
        if ($value === null) {
            return self::$nullToken;
        }

        if ($value instanceof Entities_Interface) {
            return $this->renderEntity($value);
        }

        if ($value instanceof Entities_Field_Interface) {
            return $this->renderField($value);
        }

        if (is_array($value)) {
            /**
             * PHPCS is very good way...
             */
            $isIntegerArray = is_numeric(
                join(
                    "", 
                    array_slice(array_keys($value), 0, 1) 
                )
            );
            if (empty($value) || $isIntegerArray ) { 
                return $this->renderArray($value);
            }
        }

        if (is_array($value) || is_object($value)) {
            return $this->renderMap($value);
        }

        return $this->renderValue($value);
    }

}
